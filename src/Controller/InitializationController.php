<?php

namespace App\Controller;

use App\Entity\HypothesisLake;
use App\Entity\MarketingStrategy;
use App\Form\HypothesisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
        $hypothesisLake->setPhase(0);
        $hypothesisForm = $this->createForm(HypothesisType::class, $hypothesisLake);

        return $this->render('initialization/initialization.html.twig', [
            'form' => $hypothesisForm->createView()
        ]);
    }

    /**
     * @Route("/strategy_helper", name="strategy_helper")
     * @param Request $request
     */
    public function strategyHelper(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $strategyType = $request->get('strategyType');
            if(!empty($strategyType))
                return new JsonResponse([
                    'status'=>true,
                    'strategy_description'=> MarketingStrategy::SITUATIONS[$strategyType]['description'],
                    'strategy_examples'=>MarketingStrategy::SITUATIONS[$strategyType]['examples']
                ]);
            else
                return new JsonResponse([
                    'status'=>true,
                    'strategy_description'=> "Select a marketing strategy type to see the description :)",
                    'strategy_examples'=>"Select a marketing strategy type to see the examples :)"
                ]);
        }
        return new Response("Invalid request", 400);
    }
}
