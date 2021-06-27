<?php


namespace App\Controller;


use App\Entity\Alerte;
use App\Entity\Deal;
use App\Entity\User;
use App\Form\AlerteFormType;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/myStats", name="app_account_myStats")
     */
    public function myAccount()
    {
        $user = $this->getUser();
        $hottestDeal = $this->entityManager->getRepository(Deal::class)->getHottestDealByUser($user->getEmail())[0]->getDegres();

        $oneYearAgo = new \DateTime();
        $oneYearAgo->modify('-1 years');

        $averageVotes = $this->entityManager->getRepository(Deal::class)->getAverageDealsSinceDate($this->getUser()->getEmail(),$oneYearAgo);

        // trop dur sans le les degres dans le deal , à voir.
      //  $hotDealsPercentage = $this->entityManager->getRepository(Deal::class)->hotDealsPercentage($this->getUser()->getEmail());

        return $this->render('myStats.html.twig', ['nbDeals' => $user->getDeals()->count(), "nbCommentaires" =>$user->getCommentaires()->count(), "hottestDeal" => $hottestDeal, "averageVotes" => $averageVotes]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/mesBadges", name="app_account_mesBadges")
     */
    public function mesBadges()
    {
        $badges = $this->getUser()->getBadges();

        return $this->render('mesBadges.html.twig', ['badges' => $badges]);
    }
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/mesAlertes", name="app_account_myAlerts")
     */
    public function mesAlertes(Request $request)
    {

        $alert = new Alerte();
        $form = $this->createForm(AlerteFormType::class, $alert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $alert = $form->getData();
            $alert->setUser( $this->getUser());
            $alert->setDateCreation(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($alert);
             $entityManager->flush();

            return $this->redirectToRoute('app_account_myAlerts');
        }

        $filAlertes =array();

        $alertes = $this->getUser()->getAlertes();


        foreach($alertes as $alerte){
           $subFilAlertes = $this->entityManager->getRepository(Deal::class)->getDealsForAlert($alerte);
            $filAlertes = array_merge($filAlertes, $subFilAlertes);
        }


        return $this->render('mesAlertes.html.twig',[ 'form' => $form->createView(), 'alertes' => $alertes, 'fileAlertes' => $filAlertes]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/monCompte", name="app_account_myAccount")
     */
    public function monCompte(Request $request)
    {
        $form = $this->createForm(UserFormType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_account_myAlerts');
        }

        return $this->render('myAccount.html.twig',[ 'form' => $form->createView()]);
    }
}