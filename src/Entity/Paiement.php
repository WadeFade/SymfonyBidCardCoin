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

    public function __toString()
    {
        return 'ID: '.$this->id.' ENCHERE: '.$this->enchere.' TYPE-PAIEMENT: '.$this->typePaiement;
    }

    public function getId(): ?int
    {
        return $this->id;
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
