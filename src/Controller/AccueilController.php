<?php

namespace App\Controller;

use App\Entity\BonPlan;
use App\Form\AdvertisementType;
use App\Form\BonPlanFormType;
use App\Form\CodePromoFormType;
use DateTime;
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

        $arrayType = array();
        foreach ($deals as $deal){
            array_push($arrayType, get_class($deal)) ;
        }
        return $this->render('ALaUne.html.twig', ['deals' => $deals, 'types' => $arrayType]);
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
            $bonPlan->setDateCreation(new \DateTime('now'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bonPlan);

            $entityManager->flush();
            return $this->redirectToRoute('accueil');
        }

        return $this->render('bonPlanForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
    * @IsGranted("ROLE_USER")
    * @Route("/addCodePromo")
    */
    public function addCodePromo(Request $request) :Response
    {
        $codePromo = new \App\Entity\CodePromo();

        $form = $this->createForm(CodePromoFormType::class, $codePromo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $codePromo = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($codePromo);

            $entityManager->flush();
            return $this->redirectToRoute('accueil');
        }

        return $this->render('CodePromoForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deal/{id}", name="app_deal_detail")
     */
    public function detailDeal(int $id):Response
    {
        $deal = $this->getDoctrine()->getRepository(\App\Entity\Deal::class)->find($id);

        return $this->render('detailDeal.html.twig', [
            'deal' => $deal
        ]);
    }

}
