<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datefact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typefac;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AdressLiv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressFab;

    /**
     * @ORM\Column(type="float")
     */
    private $netPayer;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nbrPalette;

    /**
     * @ORM\OneToMany(targetEntity=ProdFact::class, mappedBy="FactId",cascade={"ALL"})
     */
    private $prodFacts;

    public function __construct()
    {
        $this->prodFacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatefact(): ?\DateTimeInterface
    {
        return $this->datefact;
    }

    public function setDatefact(\DateTimeInterface $datefact): self
    {
        $this->datefact = $datefact;

        return $this;
    }

    public function getTypefac(): ?string
    {
        return $this->typefac;
    }

    public function setTypefac(?string $typefac): self
    {
        $this->typefac = $typefac;

        return $this;
    }

    public function getAdressLiv(): ?string
    {
        return $this->AdressLiv;
    }

    public function setAdressLiv(?string $AdressLiv): self
    {
        $this->AdressLiv = $AdressLiv;

        return $this;
    }

    public function getAdressFab(): ?string
    {
        return $this->adressFab;
    }

    public function setAdressFab(?string $adressFab): self
    {
        $this->adressFab = $adressFab;

        return $this;
    }

    public function getNetPayer(): ?float
    {
        return $this->netPayer;
    }

    public function setNetPayer(float $netPayer): self
    {
        $this->netPayer = $netPayer;

        return $this;
    }

    public function getNbrPalette(): ?float
    {
        return $this->nbrPalette;
    }

    public function setNbrPalette(?float $nbrPalette): self
    {
        $this->nbrPalette = $nbrPalette;

        return $this;
    }

    /**
     * @return Collection<int, ProdFact>
     */
    public function getProdFacts(): Collection
    {
        return $this->prodFacts;
    }

    public function addProdFact(ProdFact $prodFact): self
    {
        if (!$this->prodFacts->contains($prodFact)) {
            $this->prodFacts[] = $prodFact;
            $prodFact->setFactId($this);
        }

        return $this;
    }

    public function removeProdFact(ProdFact $prodFact): self
    {
        if ($this->prodFacts->removeElement($prodFact)) {
            // set the owning side to null (unless already changed)
            if ($prodFact->getFactId() === $this) {
                $prodFact->setFactId(null);
            }
        }

        return $this;
    }
}
