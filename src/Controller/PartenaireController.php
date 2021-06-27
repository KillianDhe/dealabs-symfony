<?php


namespace App\Controller;


use App\Entity\Deal;
use App\Entity\Groupe;
use App\Entity\Partenaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/displayAllPartenaires", name="app_partenaire_displayAll")
     */
    public function displayAllPartenaires(): Response
    {
        $partenaires = $this->entityManager->getRepository(Partenaire::class)->findAll();
        return $this->render('allPartenaires.html.twig', [
            'partenaires' => $partenaires,
        ]);
    }

    /**
     * @Route("/displayDealsByPartenaire/{partenaireId}", name="app_partenaire_displayDeals")
     */
    public function displayDealsByPartenaire($partenaireId): Response
    {
        $deals = $this->entityManager->getRepository(Deal::class)->getDealsByPartenaireId($partenaireId);
        $partenaire = $this->entityManager->getRepository(Partenaire::class)->find($partenaireId);
        return $this->render('deals.html.twig', ['deals' => $deals, "titre" => "Deals du partenaire ". $partenaire->getNom()]);
    }

}