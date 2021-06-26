<?php


namespace App\Event;


use App\Entity\Commentaire;
use Symfony\Contracts\EventDispatcher\Event;


class CommentairePlacedEvent extends Event
{
    public const NAME = 'commentaire.placed';

    protected $commentaire;

    public function __construct(Commentaire $commentaire)
    {
        $this->commentaire = $commentaire;
    }

    public function getCommentaire(): Commentaire
    {
        return $this->commentaire;
    }
}