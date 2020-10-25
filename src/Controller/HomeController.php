<?php

namespace App\Controller;

use App\Entity\Home;
use App\Service\EditorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, EditorService $editorService)
    {

        if ($request->isXmlHttpRequest()) {
            if(isset($_FILES['image']))
              return $editorService->uploadImage($request);
            else if($request->request->get("type")=="new_delta")
              return $editorService->insertDelta($request,Home::class);
            else if($request->request->get("type")=="cancel_delta")
                return $editorService->cancelDelta($request);
        }

        return $this->render('home/index.html.twig', [

        ]);
    }
}
