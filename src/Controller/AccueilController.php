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
     * @Route("/accueil", name="accueil")
     */
    public function displayAllDeals(): Response
    {
        $oneWeekAgo = new \DateTime();
        $oneWeekAgo->modify('-7 days');
        $deals = $this->entityManager->getRepository(Deal::class)->getALaUne($oneWeekAgo);

        $dealsHotJour = $this->entityManager->getRepository(Deal::class)->getDealsHotJour();
        return $this->render('deals.html.twig', ['deals' => $deals,'dealsJourHot'=> $dealsHotJour]);
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

}
