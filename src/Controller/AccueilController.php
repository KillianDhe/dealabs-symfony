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
     * @Route("/accueil", name="app_accueil_rechercheDeals", options={"expose"=true})
     */
    public function rechercheDeals(Request $request)
    {
        $search = $request->query->get('search');
        $deals = $this->entityManager->getRepository(Deal::class)->search($search);
        return $this->render('deals.html.twig', ['deals' => $deals,"titre"=>"Resultat de la recherche"]);
    }

    /**
     * @Route("/accueil", name="accueil", options={"expose"=true})
     */
    public function displayAllDeals(): Response
    {
        $oneWeekAgo = new \DateTime();
        $oneWeekAgo->modify('-7 days');
        $deals = $this->entityManager->getRepository(Deal::class)->getALaUne($oneWeekAgo);

        $dealsHotJour = $this->entityManager->getRepository(Deal::class)->getDealsHotJour();
        return $this->render('deals.html.twig', ['deals' => $deals,'dealsJourHot'=> $dealsHotJour,"titre"=>"Deals à la une"]);
    }


    /**
     * @Route("/allDeals", name="app_deal_tous")
     */
    public function allDeals(): Response
    {
        $deals = $this->entityManager->getRepository(Deal::class)->findAll();

        $dealsHotJour = $this->entityManager->getRepository(Deal::class)->getDealsHotJour();
        return $this->render('deals.html.twig', ['deals' => $deals,'dealsJourHot'=> $dealsHotJour,"titre"=>"Tous les deals"]);
    }

    /**
     * @Route("/hotBonPlans", name="hotBonPlans")
     */
    public function hotBonPlans(): Response
    {
        $bonPlans = $this->entityManager->getRepository(BonPlan::class)->getHot();
        return $this->render('deals.html.twig', ['deals' => $bonPlans,"titre"=>"Bons plans hot"]);
    }

    /**
     * @Route("/hotCodePromos", name="hotCodePromos")
     */
    public function hotCodePromos(): Response
    {
        $codePromos = $this->entityManager->getRepository(CodePromo::class)->getHot();
        return $this->render('deals.html.twig', ['deals' => $codePromos, "titre"=>"Codes promo hot"]);
    }

}
