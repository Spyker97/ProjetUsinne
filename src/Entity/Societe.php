<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SocieteRepository::class)
 */
class Societe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numTelephon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=ProdFact::class, mappedBy="societeee")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getNumTelephon(): ?int
    {
        return $this->numTelephon;
    }

    public function setNumTelephon(?int $numTelephon): self
    {
        $this->numTelephon = $numTelephon;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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
            $prodFact->setSocieteee($this);
        }

        return $this;
    }

    public function removeProdFact(ProdFact $prodFact): self
    {
        if ($this->prodFacts->removeElement($prodFact)) {
            // set the owning side to null (unless already changed)
            if ($prodFact->getSocieteee() === $this) {
                $prodFact->setSocieteee(null);
            }
        }

        return $this;
    }
}
