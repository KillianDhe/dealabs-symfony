<?php

namespace App\Entity;

use App\Repository\DealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Entity(repositoryClass=DealRepository::class)
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"bonPlan" = "BonPlan", "codePromo" = "CodePromo"})
 * @Vich\Uploadable
 */

abstract class Deal
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=10000, nullable=true)
     */
    protected $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $Titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $LienDuDeal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $CodePromo;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isExpire;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="deal", orphanRemoval=true)
     */
    protected $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, inversedBy="deals")
     */
    protected $groupes;

    /**
     * @ORM\ManyToMany(targetEntity=Partenaire::class, inversedBy="deals")
     */
    protected $partenaires;

    /**
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="deal", orphanRemoval=true)
     */
    protected $votes;

    /**
     * @ORM\Column(type="date")
     */
    protected $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="deals_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->groupes = new ArrayCollection();
        $this->partenaires = new ArrayCollection();
        $this->votes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getLienDuDeal(): ?string
    {
        return $this->LienDuDeal;
    }

    public function setLienDuDeal(string $LienDuDeal): self
    {
        $this->LienDuDeal = $LienDuDeal;

        return $this;
    }

    public function getCodePromo(): ?string
    {
        return $this->CodePromo;
    }

    public function setCodePromo(?string $CodePromo): self
    {
        $this->CodePromo = $CodePromo;

        return $this;
    }

    public function getIsExpire(): ?bool
    {
        return $this->isExpire;
    }

    public function setIsExpire(bool $isExpire): self
    {
        $this->isExpire = $isExpire;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setDeal($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getDeal() === $this) {
                $commentaire->setDeal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        $this->groupes->removeElement($groupe);

        return $this;
    }

    /**
     * @return Collection|Partenaire[]
     */
    public function getPartenaires(): Collection
    {
        return $this->partenaires;
    }

    public function addPartenaire(Partenaire $partenaire): self
    {
        if (!$this->partenaires->contains($partenaire)) {
            $this->partenaires[] = $partenaire;
        }

        return $this;
    }

    public function removePartenaire(Partenaire $partenaire): self
    {
        $this->partenaires->removeElement($partenaire);

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setDeal($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getDeal() === $this) {
                $vote->setDeal(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function getDegres(): int
    {
        $degres = 0;
        foreach($this->getVotes() as $vote ){
            $degres+= $vote->getValeur();
         }
        return $degres;
    }


    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public abstract function getType():string;

    public function setImageFile(File $image = null)
    {
      $this->imageFile = $image;

      // VERY IMPORTANT:
      // It is required that at least one field changes if you are using Doctrine,
      // otherwise the event listeners won't be called and the file is lost
      if ($image) {
        // if 'updatedAt' is not defined in your entity, use another property
        $this->updatedAt = new \DateTime('now');
      }
    }

    public function getImageFile()
    {
      return $this->imageFile;
    }

    public function setImage($image)
    {
      $this->image = $image;
    }

    public function getImage()
    {
      if (empty($this->image)) {
        return 'default.svg';
      }
      return $this->image;
    }
}
