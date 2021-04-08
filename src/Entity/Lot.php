<?php

namespace App\Entity;

use App\Repository\LotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LotRepository::class)
 */
class Lot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomLot;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="lot")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="lot")
     */
    private $encheres;

    /**
     * @ORM\OneToMany(targetEntity=OrdreAchat::class, mappedBy="lot")
     */
    private $ordreAchats;

    /**
     * @ORM\OneToOne(targetEntity=Vente::class, inversedBy="lot", cascade={"persist", "remove"})
     */
    private $vente;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->encheres = new ArrayCollection();
        $this->ordreAchats = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nomLot;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLot(): ?string
    {
        return $this->nomLot;
    }

    public function setNomLot(string $nomLot): self
    {
        $this->nomLot = $nomLot;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setLot($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getLot() === $this) {
                $produit->setLot(null);
            }
        }

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
            $enchere->setLot($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getLot() === $this) {
                $enchere->setLot(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrdreAchat[]
     */
    public function getOrdreAchats(): Collection
    {
        return $this->ordreAchats;
    }

    public function addOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if (!$this->ordreAchats->contains($ordreAchat)) {
            $this->ordreAchats[] = $ordreAchat;
            $ordreAchat->setLot($this);
        }

        return $this;
    }

    public function removeOrdreAchat(OrdreAchat $ordreAchat): self
    {
        if ($this->ordreAchats->removeElement($ordreAchat)) {
            // set the owning side to null (unless already changed)
            if ($ordreAchat->getLot() === $this) {
                $ordreAchat->setLot(null);
            }
        }

        return $this;
    }

    public function getVente(): ?Vente
    {
        return $this->vente;
    }

    public function setVente(?Vente $vente): self
    {
        $this->vente = $vente;

        return $this;
    }
}
