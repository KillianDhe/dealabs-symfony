<?php

namespace App\Controller;

use App\Form\AdvertisementType;
use App\Form\BonPlanFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function displayAllDeals(): Response
    {
        $deals = $this->getDoctrine()->getRepository(\App\Entity\Deal::class)->findAll();
        return $this->render('ALaUne.html.twig', ['deals' => $deals]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/addBonPlan")
     */
    public function addBonPlan(Request $request) :Response
    {
        $bonPlan = new \App\Entity\BonPlan();
        $form = $this->createForm(BonPlanFormType::class, $bonPlan);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bonPlan = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bonPlan);

            $entityManager->flush();
            return $this->redirectToRoute('accueil');
        }

        return $this->render('bonPlanForm.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}