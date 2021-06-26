<?php


namespace App\Event;


use App\Entity\Badge;
use App\Entity\Commentaire;
use App\Entity\Deal;
use App\Entity\Vote;
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
        if($nbCommentaire >= 10){
        $badge =  $this->entityManager->getRepository(Badge::class)->findOneBy(array("Nom" => "Rapport de stage"));
            if($badge != null) {
                if(!$auteur->getBadges()->contains($badge)){
                    $auteur->addBadge($badge);
                    $this->entityManager->persist($auteur);
                    $this->entityManager->flush();
                }
            }
         }
    }

    public function onDealPosted(DealPostedEvent $event)
    {
        $auteur = $event->getDeal()->getAuthor();
        $nbDeals = $this->entityManager->getRepository(Deal::class)->count(array("author" => $auteur));
        if($nbDeals >= 10){
            $badge =  $this->entityManager->getRepository(Badge::class)->findOneBy(array("Nom" => "Cobaye"));
            if($badge != null){
                if(!$auteur->getBadges()->contains($badge)) {
                    $auteur->addBadge($badge);
                    $this->entityManager->persist($auteur);
                    $this->entityManager->flush();
                }
            }
        }
    }


    public function onVotePlaced(VotePlacedEvent $event)
    {
        $auteur = $event->getVote()->getUtilisateur();
        $nbVotes = $this->entityManager->getRepository(Vote::class)->count(array("Utilisateur" => $auteur));
        if($nbVotes >= 10){
            $badge =  $this->entityManager->getRepository(Badge::class)->findOneBy(array("Nom" => "Surveillant"));
            if($badge != null) {
                if(!$auteur->getBadges()->contains($badge)) {
                    $auteur->addBadge($badge);
                    $this->entityManager->persist($auteur);
                    $this->entityManager->flush();
                }
            }
        }
    }
}