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

class DealController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/signaler/{dealId}", name="app_deal_signaler")
     */
    public function signalerDeal(int $dealId, \Swift_Mailer $mailer)
    {
        $deal = $this->getDoctrine()->getRepository(\App\Entity\Deal::class)->find($dealId);

        $user = $this->getUser();
        $message = (new \Swift_Message('Deal signalé '.$dealId))
            ->setFrom($user->getUsername())
            ->setTo('moderation@dealabs.com')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/signalement.html.twig',
                    ['deal' => $deal]
                ),
                'text/html'
            );

        $mailer->send($message);
        return $this->redirectToRoute('app_deal_detail', ['id' => $dealId]);

    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/voterPlus/{id}", name="app_deal_voterPlus", options={"expose"=true})
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
        return new Response($deal->getDegres());
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/voterMoins/{id}", name="app_deal_voterMoins", options={"expose"=true})
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
        return new Response($deal->getDegres());
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
            $bonPlan->setAuthor($this->getUser());
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
   * @Route("/editBonPlan/{id}")
   */
  public function editBonPlan(int $id, Request $request) :Response
  {
    $bonPlan = $this->getDoctrine()->getRepository(\App\Entity\BonPlan::class)->find($id);
    if (!$bonPlan) {
      $bonPlan = new BonPlan();
    }
    $form = $this->createForm(BonPlanFormType::class, $bonPlan);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $bonPlan = $form->getData();
      $bonPlan->setAuthor($this->getUser());
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
            $codePromo->setAuthor($this->getUser());
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

        return $this->render('entity/deal/deal.html.twig', [
            'deal' => $deal,
            'form' => $commentaireForm->createView(),
        ]);
    }
}
