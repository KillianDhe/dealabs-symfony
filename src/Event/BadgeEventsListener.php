<?php


namespace App\Event;


use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BadgeEventsListener implements EventSubscriberInterface
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            CommentairePlacedEvent::NAME => 'onCommentairePlaced',
            DealPostedEvent::NAME => 'onDealPosted',
            VotePlacedEvent::NAME => 'onVotePlaced'
        ];
    }


    public function onCommentairePlaced(CommentairePlacedEvent $event)
    {
       $auteur = $event->getCommentaire()->getAuteur();
       $nbCommentaire = $this->entityManager->getRepository(Commentaire::class)->count(array("auteur" => $auteur));
       dump($nbCommentaire);
       die();

    }

    public function onDealPosted(DealPostedEvent $event)
    {
    }


    public function onVotePlaced(VotePlacedEvent $event)
    {
    }
}