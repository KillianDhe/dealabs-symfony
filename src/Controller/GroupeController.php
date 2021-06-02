<?php


namespace App\Controller;


use App\Entity\Deal;
use App\Entity\Groupe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/displayAllGroupes", name="displayAllGroupes")
     */
    public function displayAllGroupes(): Response
    {
        $groupes = $this->entityManager->getRepository(Groupe::class)->findAll();
        return $this->render('allGroupes.html.twig', [
            'groupes' => $groupes,
        ]);
    }

    /**
     * @Route("/displayDealsByGroupe/{dealId}", name="app_groupe_displayDealsByGroupe")
     */
    public function displayDealsByGroupe($dealId): Response
    {
        $deals = $this->entityManager->getRepository(Deal::class)->getDealsByGroupeId($dealId);
        return $this->render('deals.html.twig', ['deals' => $deals]);
    }

}