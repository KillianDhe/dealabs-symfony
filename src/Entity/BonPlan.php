<?php

namespace App\Entity;

use App\Repository\BonPlanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BonPlanRepository::class)
 */
class BonPlan extends Deal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Prix;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PrixHabituel;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $FraisDePort;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isLivraisonGratuite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(?float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getPrixHabituel(): ?float
    {
        return $this->PrixHabituel;
    }

    public function setPrixHabituel(?float $PrixHabituel): self
    {
        $this->PrixHabituel = $PrixHabituel;

        return $this;
    }

    public function getFraisDePort(): ?float
    {
        return $this->FraisDePort;
    }

    public function setFraisDePort(?float $FraisDePort): self
    {
        $this->FraisDePort = $FraisDePort;

        return $this;
    }

    public function getIsLivraisonGratuite(): ?bool
    {
        return $this->isLivraisonGratuite;
    }

    public function setIsLivraisonGratuite(bool $isLivraisonGratuite): self
    {
        $this->isLivraisonGratuite = $isLivraisonGratuite;

        return $this;
    }

    public function getType():string{
        return "BonPlan";
    }
}
