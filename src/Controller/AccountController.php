<?php


namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
       return $this->render('deals.html.twig', ['deals' => $dealsSaved]);

    }


    /**
     * @IsGranted("ROLE_USER")
     * @Route("/saveDeals/{dealId}", name="app_account_saveDeal")
     */
    public function saveDeal(int $dealId)
    {
        $deal = $this->getDoctrine()->getRepository(\App\Entity\Deal::class)->find($dealId);
        $this->getUser()->addDealsSaved($deal);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($this->getUser());

        $entityManager->flush();

        return $this->redirectToRoute('app_deal_detail', ["id" => $dealId]);

    }

}