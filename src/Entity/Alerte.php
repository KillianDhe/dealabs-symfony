<?php

namespace App\Entity;

use App\Repository\AlerteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlerteRepository::class)
 */
class Alerte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recherche;


    /**
     * @ORM\Column(type="integer")
     */
    private $temperatureMin;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSendEmail;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="alertes")
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecherche(): ?string
    {
        return $this->recherche;
    }

    public function setRecherche(string $recherche): self
    {
        $this->recherche = $recherche;

        return $this;
    }

    public function getTemperatureMin(): ?int
    {
        return $this->temperatureMin;
    }

    public function setTemperatureMin(int $temperatureMin): self
    {
        $this->temperatureMin = $temperatureMin;

        return $this;
    }

    public function getIsSendEmail(): ?bool
    {
        return $this->isSendEmail;
    }

    public function setIsSendEmail(?bool $isSendEmail): self
    {
        $this->isSendEmail = $isSendEmail;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
}
