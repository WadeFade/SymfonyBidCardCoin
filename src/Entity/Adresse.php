<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rue;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Vente::class, mappedBy="adresse")
     */
    private $salleEncheres;

    /**
     * @ORM\OneToMany(targetEntity=Stockage::class, mappedBy="adresse")
     */
    private $stockages;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="adresses")
     */
    private $personnes;

    public function __construct()
    {
        $this->salleEncheres = new ArrayCollection();
        $this->stockages = new ArrayCollection();
        $this->personnes = new ArrayCollection();
    }

    public function __toString()
    {
        $toReturn = $this->num .' '. $this->rue .' '.$this->ville;
        return $toReturn;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Vente[]
     */
    public function getVentes(): Collection
    {
        return $this->salleEncheres;
    }

    public function addVente(Vente $salleEnchere): self
    {
        if (!$this->salleEncheres->contains($salleEnchere)) {
            $this->salleEncheres[] = $salleEnchere;
            $salleEnchere->setAdresse($this);
        }

        return $this;
    }

    public function removeVente(Vente $salleEnchere): self
    {
        if ($this->salleEncheres->removeElement($salleEnchere)) {
            // set the owning side to null (unless already changed)
            if ($salleEnchere->getAdresse() === $this) {
                $salleEnchere->setAdresse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Stockage[]
     */
    public function getStockages(): Collection
    {
        return $this->stockages;
    }

    public function addStockage(Stockage $stockage): self
    {
        if (!$this->stockages->contains($stockage)) {
            $this->stockages[] = $stockage;
            $stockage->setAdresse($this);
        }

        return $this;
    }

    public function removeStockage(Stockage $stockage): self
    {
        if ($this->stockages->removeElement($stockage)) {
            // set the owning side to null (unless already changed)
            if ($stockage->getAdresse() === $this) {
                $stockage->setAdresse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(User $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes[] = $personne;
        }

        return $this;
    }

    public function removePersonne(User $personne): self
    {
        $this->personnes->removeElement($personne);

        return $this;
    }
}
