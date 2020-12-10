<?php

namespace App\Controller;

use App\Entity\HypothesisLake;
use App\Form\HypothesisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InitializationController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('initialization/index.html.twig', [

        ]);
    }

    /**
     * @Route("/initialization", name="initialization")
     */
    public function initialize(): Response
    {
        $hypothesisLake = new HypothesisLake();
        $hypothesisForm = $this->createForm(HypothesisType::class, $hypothesisLake);

        return $this->render('initialization/initialization.html.twig', [
            'form'=>$hypothesisForm->createView()
        ]);
    }
}
