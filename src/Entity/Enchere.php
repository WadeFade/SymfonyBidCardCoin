<?php

namespace App\Entity;

use App\Repository\EnchereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnchereRepository::class)
 */
class Enchere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $dateEnchere;

    /**
     * @ORM\Column(type="float")
     */
    private $prixPropose;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estAdjuge;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="encheres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lot;

    /**
     * @ORM\ManyToOne(targetEntity=OrdreAchat::class, inversedBy="encheres")
     */
    private $ordreAchat;

    /**
     * @ORM\OneToOne(targetEntity=Paiement::class, mappedBy="enchere", cascade={"persist", "remove"})
     */
    private $paiement;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="encheresAsCommissaire")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commissaire;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="encheresAsEncherisseur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $encherisseur;

//    TODO trouvé une façon d'afficher plus d'info ? (pas prioritaire)
    public function __toString()
    {
      return (string)$this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEnchere(): ?\DateTimeImmutable
    {
        return $this->dateEnchere;
    }

    public function setDateEnchere(\DateTimeImmutable $dateEnchere): self
    {
        $this->dateEnchere = $dateEnchere;

        return $this;
    }

    public function getPrixPropose(): ?float
    {
        return $this->prixPropose;
    }

    public function setPrixPropose(float $prixPropose): self
    {
        $this->prixPropose = $prixPropose;

        return $this;
    }

    public function getEstAdjuge(): ?bool
    {
        return $this->estAdjuge;
    }

    public function setEstAdjuge(bool $estAdjuge): self
    {
        $this->estAdjuge = $estAdjuge;

        return $this;
    }

    public function getLot(): ?Lot
    {
        return $this->lot;
    }

    public function setLot(?Lot $lot): self
    {
        $this->lot = $lot;

        return $this;
    }

    public function getOrdreAchat(): ?OrdreAchat
    {
        return $this->ordreAchat;
    }

    public function setOrdreAchat(?OrdreAchat $ordreAchat): self
    {
        $this->ordreAchat = $ordreAchat;

        return $this;
    }

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(Paiement $paiement): self
    {
        // set the owning side of the relation if necessary
        if ($paiement->getEnchere() !== $this) {
            $paiement->setEnchere($this);
        }

        $this->paiement = $paiement;

        return $this;
    }

    public function getCommissaire(): ?User
    {
        return $this->commissaire;
    }

    public function setCommissaire(?User $commissaire): self
    {
        $this->commissaire = $commissaire;

        return $this;
    }

    public function getEncherisseur(): ?User
    {
        return $this->encherisseur;
    }

    public function setEncherisseur(?User $encherisseur): self
    {
        $this->encherisseur = $encherisseur;

        return $this;
    }
}
