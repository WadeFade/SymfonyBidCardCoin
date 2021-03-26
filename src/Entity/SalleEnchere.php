<?php

namespace App\Entity;

use App\Repository\SalleEnchereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalleEnchereRepository::class)
 */
class SalleEnchere
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
    private $nomVente;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class, inversedBy="salleEncheres")
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Enchere::class, mappedBy="salleVente")
     */
    private $encheres;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateStart;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="salleEncheres")
     */
    private $commissaire;

    public function __construct()
    {
        $this->encheres = new ArrayCollection();
        $this->dateStart = new \DateTimeImmutable("now");
    }

    public function __toString()
    {
        return $this->nomVente;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVente(): ?string
    {
        return $this->nomVente;
    }

    public function setNomVente(string $nomVente): self
    {
        $this->nomVente = $nomVente;

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

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

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
            $enchere->setSalleVente($this);
        }

        return $this;
    }

    public function removeEnchere(Enchere $enchere): self
    {
        if ($this->encheres->removeElement($enchere)) {
            // set the owning side to null (unless already changed)
            if ($enchere->getSalleVente() === $this) {
                $enchere->setSalleVente(null);
            }
        }

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(?\DateTimeInterface $dateStart): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

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
