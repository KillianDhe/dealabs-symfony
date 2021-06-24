<?php


namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/dealsSaved/", name="app_account_dealsSaved")
     */
    public function afficherDealsSaved()
    {
       $dealsSaved = $this->getUser()->getDealsSaved();
       return $this->render('deals.html.twig', ['deals' => $dealsSaved, "titre" => "Deals sauvegardés"]);

    }


    /**
     * @IsGranted("ROLE_USER")
     * @Route("/saveDeal/{dealId}", name="app_account_saveDeal", options={"expose"=true})
     */
    public function saveDeal(int $dealId): Response
    {
        $deal = $this->getDoctrine()->getRepository(\App\Entity\Deal::class)->find($dealId);
        $this->getUser()->addDealsSaved($deal);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($this->getUser());

        $entityManager->flush();

        return new Response();
    }

  /**
   * @IsGranted("ROLE_USER")
   * @Route("/removeDealSaved/{dealId}", name="app_account_removeDealSaved", options={"expose"=true})
   */
  public function removeDealSaved(int $dealId): Response
  {
    $deal = $this->getDoctrine()->getRepository(\App\Entity\Deal::class)->find($dealId);
    $this->getUser()->removeDealsSaved($deal);

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($this->getUser());

    $entityManager->flush();

    return new Response();
  }

  /**
   * @IsGranted("ROLE_USER")
   * @Route("/myDeals", name="app_account_myDeals")
   */
  public function myDeals()
  {
    $deals = $this->getUser()->getDeals();

    return $this->render('deals.html.twig', ['deals' => $deals, "titre" => "Mes deals"]);
  }

}