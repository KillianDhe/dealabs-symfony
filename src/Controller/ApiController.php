<?php


namespace App\Controller;


use App\Entity\Deal;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     *
     * @Route("/api/getWeeklyDeals", name="app_api_getWeeklyDeals")
     * @Method("GET")
     */
    public function getWeeklyDeals(): Response
    {
        $weekAgo = new \DateTime();
        $weekAgo->modify("-7 day");

        $deals = $this->entityManager->getRepository(Deal::class)->getDealsFromDate($weekAgo);
        $response = new Response(json_encode($deals));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    /**
     *@IsGranted("ROLE_USER")
     * @Route("/api/private/getDealsSaved", name="getDealsSaved")
     * @Method("GET")
     */
    public function getDealsSaved(): Response
    {
        $weekAgo = new \DateTime();
        $weekAgo->modify("-7 day");

        $deals = $this->entityManager->getRepository(Deal::class)->getDealsSaved($this->getUser()->getEmail());

        $response = new Response(json_encode($deals));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

    /**
     *@IsGranted("ROLE_USER")
     * @Route("/generateApiToken", name="app_api_generateToken")
     */
    public function generateApiToken(): Response
    {

        $newToken = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
        $this->getUser()->setApiToken($newToken);
        $this->entityManager->persist($this->getUser());
        $this->entityManager->flush();
        return $this->redirectToRoute("app_account_myAccount");
    }

}