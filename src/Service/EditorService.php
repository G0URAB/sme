<?php

namespace App\Service;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Asset\UrlPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

Class EditorService{

    private $imageDirectory;
    private $urlPackage;
    private $entityManager;
    private $security;
    private $session;

    public function __construct($imageDirectory,$entityManager, Security $security, SessionInterface $session)
    {
        $this->imageDirectory = $imageDirectory;
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->session = $session;
        $this->urlPackage = new UrlPackage("https://" . $_SERVER["SERVER_NAME"] . "/images/delta", new EmptyVersionStrategy());
    }

    public function uploadImage(Request $request)
    {
        $image = $request->files->get('image');
        $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $fileName = $safeFilename.rand(). "." . $image->guessExtension();
        $url = $this->urlPackage->getUrl($fileName);

        if ($this->session->has('temp_images')) {
            $temp_images = $this->session->get('temp_images');
            array_push($temp_images, $fileName);
            $this->session->set('temp_images', $temp_images);
        } else {
            $this->session->set('temp_images', [$fileName]);
        }

        $image->move($this->imageDirectory, $fileName);
        return new JsonResponse(array("status" => "Image upload success", "url" => $url));
    }

    public function insertDelta(Request $request, $pageClass)
    {
        $entity = $this->entityManager->getRepository($pageClass)
                 ->find($request->request->get("id"));

        $entityExist = false;

        if($entity==null){
            $entityExist = true;
            $entity = new $pageClass;
        }
        $entity->setUser($this->security->getUser());
        $this->security->getUser()->setHome($entity);
        $entity->setDelta($request->request->get("content"));
        if($entityExist)
            $this->entityManager->persist($entity);
        $this->entityManager->flush();

        //This section is for deleting images
        /**
         * $new_image_array extracts images from current
         * brand new delta.
         */
        $new_image_array = [];
        $json_array = json_decode($request->request->get("content"));
        foreach ($json_array->ops as $child_ops) {
            if (isset($child_ops->insert->image))
                array_push($new_image_array, $child_ops->insert->image);
        }
        //print_r($image_array);

        /**$_POST['files'] is an array which gets filled by
         * ImageHandler in frontend, when user clicks on image
         * upload button.
         */
        if ($this->session->has('temp_images')) {
            $temp_images = $this->session->get('temp_images');
            for ($i = 0; $i < sizeof($temp_images); $i++) {
                $delete_image = true;
                foreach ($new_image_array as $image) {
                    if (strpos($image, $temp_images[$i]) !== false)
                        $delete_image = false;
                }
                if ($delete_image) {
                    unlink($_SERVER['DOCUMENT_ROOT']  . "images\delta\\" . $temp_images[$i]);
                }
            }
            $this->session->remove('temp_images');
        }

        return new JsonResponse(array("status" => "success","text"=>"Delta updated"));
    }

    public function cancelDelta(Request $request)
    {
        $temp_images = $this->session->has('temp_images') ? $this->session->get('temp_images') : [];

        for ($i = 0; $i < sizeof($temp_images); $i++) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "\images\delta\\" . $temp_images[$i]))
                unlink($_SERVER['DOCUMENT_ROOT'] . "\images\delta\\" . $temp_images[$i]);
        }
        $this->session->remove('temp_images');
        return new JsonResponse(array("status" => "success", "text"=>"Temp images removed"));
    }
}