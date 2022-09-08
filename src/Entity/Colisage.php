<?php

namespace App\Entity;

use App\Repository\ColisageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColisageRepository::class)
 */
class Colisage
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
    private $reference;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $remarque;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $colisage;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $numColi;

    /**
     * @ORM\OneToOne(targetEntity=Produit::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numOF;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getColisage(): ?string
    {
        return $this->colisage;
    }

    public function setColisage(?string $colisage): self
    {
        $this->colisage = $colisage;

        return $this;
    }

    public function getNumColi(): ?string
    {
        return $this->numColi;
    }

    public function setNumColi(?string $numColi): self
    {
        $this->numColi = $numColi;

        return $this;
    }

    public function getNumOF(): ?Produit
    {
        return $this->numOF;
    }

    public function setNumOF(Produit $numOF): self
    {
        $this->numOF = $numOF;

        return $this;
    }
}
