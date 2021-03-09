<?php

namespace App\Entity;

use App\Repository\OrdreAchatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdreAchatRepository::class)
 */
class OrdreAchat
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
    private $idOrdreAchat;

    /**
     * @ORM\Column(type="float")
     */
    private $prixMax;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $dateOrdreAchat;

    /**
     * @ORM\ManyToOne(targetEntity=Lot::class, inversedBy="ordreAchats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lot;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="ordreAchat")
     */
    private $encheres;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ordreAchats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderer;

    public function __construct()
    {
        $this->encheres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOrdreAchat(): ?string
    {
        return $this->idOrdreAchat;
    }

    public function setIdOrdreAchat(string $idOrdreAchat): self
    {
        $this->idOrdreAchat = $idOrdreAchat;

        return $this;
    }

    public function getPrixMax(): ?float
    {
        return $this->prixMax;
    }

    public function setPrixMax(float $prixMax): self
    {
        $this->prixMax = $prixMax;

        return $this;
    }

    public function getDateOrdreAchat(): ?\DateTimeImmutable
    {
        return $this->dateOrdreAchat;
    }

    public function setDateOrdreAchat(\DateTimeImmutable $dateOrdreAchat): self
    {
        $this->dateOrdreAchat = $dateOrdreAchat;

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

    /**
     * @return Collection|Enchere[]
     */
    public function getEncheres(): Collection
    {
        return $this->encheres;
    }

    public function addEnchere(Enchere $enchere): self
    {
        if (!$this->encheres->contains($enchere)) {
            $this->encheres[] = $enchere;
            $enchere->setOrdreAchat($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getOrdreAchat() === $this) {
                $enchere->setOrdreAchat(null);
            }
        }

        return $this;
    }

    public function getOrderer(): ?User
    {
        return $this->orderer;
    }

    public function setOrderer(?User $orderer): self
    {
        $this->orderer = $orderer;

        return $this;
    }
}
