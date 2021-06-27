<?php


namespace App\Event;


use App\Entity\Deal;
use App\Entity\Vote;
use Symfony\Contracts\EventDispatcher\Event;

class VotePlacedEvent extends Event
{
    public const NAME = 'event.placed';

    protected $vote;

    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    public function getVote(): Vote
    {
        return $this->vote;
    }
}