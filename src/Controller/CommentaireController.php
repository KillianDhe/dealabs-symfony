<?php


namespace App\Controller;


use App\Entity\Commentaire;
use App\Entity\Deal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/addCommentaire/{id}", name="addCommentaire")
     */
    public function addCommentaire(int $id,Request $request): Response
    {
        $deal = $this->entityManager->getRepository(Deal::class)->find($id);
        $commentaire = new Commentaire(new \DateTime(),"ds",$this->getUser(),$deal);
        $deal->addCommentaire($commentaire);
        $this->entityManager->persist($commentaire);
        $this->entityManager->flush();
        $response = $this->forward('App\Controller\AccueilController::detailDeal', [
            'id'  => $id
        ]);

        return $response;
    }
}