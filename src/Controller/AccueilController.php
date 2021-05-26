<?php

namespace App\Controller;

use App\Entity\BonPlan;
use App\Entity\CodePromo;
use App\Entity\Commentaire;
use App\Entity\Deal;
use App\Entity\Vote;
use App\Form\AdvertisementType;
use App\Form\BonPlanFormType;
use App\Form\CodePromoFormType;
use App\Form\CommentaireFormType;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/voterPlus/{id}", name="app_deal_voterPlus")
     */
    public function voterPlus(int $id): Response
    {
        $deal = $this->getDoctrine()->getRepository(\App\Entity\Deal::class)->find($id);
        $vote = new Vote();
        $vote->setUtilisateur($this->getUser());
        $vote->setDeal($deal);
        $vote->setValeur(1);
        $deal->addVote($vote);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($vote);

        $entityManager->flush();
        return $this->redirectToRoute('app_deal_detail', ['id' => $id]);

    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/voterMoins/{id}", name="app_deal_voterMoins")
     */
    public function voterMoins(int $id): Response
    {
        $deal = $this->getDoctrine()->getRepository(\App\Entity\Deal::class)->find($id);
        $vote = new Vote();
        $vote->setUtilisateur($this->getUser());
        $vote->setDeal($deal);
        $vote->setValeur(-1);
        $deal->addVote($vote);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($vote);

        $entityManager->flush();
        return $this->redirectToRoute('app_deal_detail', ['id' => $id]);

    }

    /**
     * @Route("/accueil", name="accueil")
     */
    public function displayAllDeals(): Response
    {
        $oneWeekAgo = new \DateTime();
        $oneWeekAgo->modify('-7 days');
        $deals = $this->entityManager->getRepository(Deal::class)->getALaUne($oneWeekAgo);
        return $this->render('deals.html.twig', ['deals' => $deals,'date'=> $oneWeekAgo]);
    }


    /**
     * @Route("/hotBonPlans", name="hotBonPlans")
     */
    public function hotBonPlans(): Response
    {
        $bonPlans = $this->entityManager->getRepository(BonPlan::class)->getHot();
        return $this->render('deals.html.twig', ['deals' => $bonPlans]);
    }

    /**
     * @Route("/hotCodePromos", name="hotCodePromos")
     */
    public function hotCodePromos(): Response
    {
        $codePromos = $this->entityManager->getRepository(CodePromo::class)->getHot();
        return $this->render('deals.html.twig', ['deals' => $codePromos]);
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
            $codePromo->setDateCreation(new \DateTime('now'));

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
    public function detailDeal(int $id,Request $request):Response
    {
        $deal = $this->getDoctrine()->getRepository(\App\Entity\Deal::class)->find($id);
        $commentaire = new \App\Entity\Commentaire();

        $commentaireForm = $this->createForm(CommentaireFormType    ::class, $commentaire);

        $commentaireForm->handleRequest($request);
        if ($commentaireForm->isSubmitted() && $commentaireForm->isValid()) {
            $commentaire = $commentaireForm->getData();
            $commentaire->setDateHeure(new DateTime());
            $commentaire->setAuteur($this->getUser());
            $commentaire->setDeal($deal);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);

            $entityManager->flush();
            return $this->redirectToRoute('app_deal_detail', ['id' => $id]);
        }

        return $this->render('detailDeal.html.twig', [
            'deal' => $deal,
            'form' => $commentaireForm->createView(),
        ]);
    }

}
