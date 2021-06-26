<?php


namespace App\Event;

use App\Entity\Commentaire;
use App\Entity\Deal;
use Symfony\Contracts\EventDispatcher\Event;

class DealPostedEvent extends Event
{
    public const NAME = 'deal.posted';

    protected $deal;

    public function __construct(Deal $deal)
    {
        $this->deal = $deal;
    }

    public function getDeal(): Deal
    {
        return $this->deal;
    }
}