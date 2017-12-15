<?php

namespace App\Controller;

use App\Form\CubeSummationType;
use App\Model\CubeSummation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function index(Request $request)
    {
        $cubeSummation  = new CubeSummation();

        $form = $this->createForm(CubeSummationType::class, $cubeSummation);

        $form->handleRequest($request);

        $awns = [];
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CubeSummation $cubeSummation */
            $cubeSummation = $form->getData();
            $awns = $cubeSummation->output();
        }

        return $this->render('default.html.twig', [
            'form' => $form->createView(),
            'cs' => $cubeSummation,
            'anws' => $awns
        ]);
    }
}