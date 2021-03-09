<?php

namespace App\Entity;

use App\Repository\EstimationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstimationRepository::class)
 */
class Estimation
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
    private $idEstimation;

    /**
     * @ORM\ManyToOne(targetEntity=produit::class, inversedBy="estimations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;
    
    /**
     * @ORM\Column(type="float")
     */
    private $prixEstimation;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $dateEstimation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="estimations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commissaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEstimation(): ?string
    {
        return $this->idEstimation;
    }

    public function setIdEstimation(string $idEstimation): self
    {
        $this->idEstimation = $idEstimation;

        return $this;
    }

    public function getProduit(): ?produit
    {
        return $this->produit;
    }

    public function setProduit(?produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getPrixEstimation(): ?float
    {
        return $this->prixEstimation;
    }

    public function setPrixEstimation(float $prixEstimation): self
    {
        $this->prixEstimation = $prixEstimation;

        return $this;
    }

    public function getDateEstimation(): ?\DateTimeImmutable
    {
        return $this->dateEstimation;
    }

    public function setDateEstimation(\DateTimeImmutable $dateEstimation): self
    {
        $this->dateEstimation = $dateEstimation;

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
}
