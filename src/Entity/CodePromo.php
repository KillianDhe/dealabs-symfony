<?php

namespace App\Entity;

use App\Repository\CodePromoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CodePromoRepository::class)
 */
class CodePromo extends Deal
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
    private $Montant;

    /** @ORM\Column(type="string", length=255) */
    private $typeReduction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->Montant;
    }

    public function setMontant(?float $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getTypeReduction(): ?string
    {
        return $this->typeReduction;
    }

    public function setTypeReduction(?string $typeReduction): self
    {
        $this->typeReduction = $typeReduction;

        return $this;
    }
}
