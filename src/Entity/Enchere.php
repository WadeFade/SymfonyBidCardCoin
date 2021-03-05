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
     * @ORM\Column(type="string", length=255)
     */
    private $idEnchere;

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
     * @ORM\ManyToOne(targetEntity=personne::class, inversedBy="encheresAsCommissaire")
     */
    private $commissaire;

    /**
     * @ORM\ManyToOne(targetEntity=personne::class, inversedBy="encheresAsEncherisseur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $encherisseur;

    /**
     * @ORM\ManyToOne(targetEntity=OrdreAchat::class, inversedBy="encheres")
     */
    private $ordreAchat;

    /**
     * @ORM\ManyToOne(targetEntity=salleEnchere::class, inversedBy="encheres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $salleVente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEnchere(): ?string
    {
        return $this->idEnchere;
    }

    public function setIdEnchere(string $idEnchere): self
    {
        $this->idEnchere = $idEnchere;

        return $this;
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

    public function getCommissaire(): ?personne
    {
        return $this->commissaire;
    }

    public function setCommissaire(?personne $commissaire): self
    {
        $this->commissaire = $commissaire;

        return $this;
    }

    public function getEncherisseur(): ?personne
    {
        return $this->encherisseur;
    }

    public function setEncherisseur(?personne $encherisseur): self
    {
        $this->encherisseur = $encherisseur;

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

    public function getSalleVente(): ?salleEnchere
    {
        return $this->salleVente;
    }

    public function setSalleVente(?salleEnchere $salleVente): self
    {
        $this->salleVente = $salleVente;

        return $this;
    }
}
