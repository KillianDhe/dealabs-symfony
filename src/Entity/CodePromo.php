<?php

namespace App\Entity;

use App\Repository\CodePromoRepository;
use Doctrine\DBAL\Exception;
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

    /**
     * @throws Exception
     */
    public function setTypeReduction(?string $typeReduction): self
    {
        $typesAutorises = array('pourcentage','euros','livraison gratuite');

        if(in_array($typeReduction,$typesAutorises)){
            $this->typeReduction = $typeReduction;
        }
        else{
            throw new Exception("Le type de récution doit etre un pourcentage, des euros ou livraison gratuite");
        }

        return $this;
    }

    public function getType():string{
        return "CodePromo";
    }
}
