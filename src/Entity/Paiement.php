<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaiementRepository::class)
 */
class Paiement
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
    private $idPaiement;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $typePaiement;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validationPaiement;

    /**
     * @ORM\OneToOne(targetEntity=Enchere::class, inversedBy="paiement", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $enchere;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPaiement(): ?string
    {
        return $this->idPaiement;
    }

    public function setIdPaiement(string $idPaiement): self
    {
        $this->idPaiement = $idPaiement;

        return $this;
    }

    public function getTypePaiement(): ?string
    {
        return $this->typePaiement;
    }

    public function setTypePaiement(?string $typePaiement): self
    {
        $this->typePaiement = $typePaiement;

        return $this;
    }

    public function getValidationPaiement(): ?bool
    {
        return $this->validationPaiement;
    }

    public function setValidationPaiement(bool $validationPaiement): self
    {
        $this->validationPaiement = $validationPaiement;

        return $this;
    }

    public function getEnchere(): ?Enchere
    {
        return $this->enchere;
    }

    public function setEnchere(Enchere $enchere): self
    {
        $this->enchere = $enchere;

        return $this;
    }
}
