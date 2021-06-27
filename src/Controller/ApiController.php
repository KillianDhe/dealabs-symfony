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
     * @Route("/api/getWeeklyDeals2", name="app_api_getWeeklyDeals2")
     * @Method("GET")
     */
    public function getWeeklyDeals2(): Response
    {
        $weekAgo = new \DateTime();
        $weekAgo->modify("-7 day");



        $response = new Response(json_encode($this->getUser()->getDealsSaved()->toArray()));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }
}