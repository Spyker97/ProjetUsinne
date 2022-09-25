<?php

namespace App\Entity;

use App\Repository\ProdFactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProdFactRepository::class)
 */
class ProdFact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class)
     */
    private $prodId;

    /**
     * @ORM\ManyToOne(targetEntity=Facture::class, inversedBy="prodFacts")
     */
    private $FactId;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datePrevu;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $factureExport;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $declarDouane;

    /**
     * @ORM\ManyToOne(targetEntity=Societe::class, inversedBy="prodFacts")
     */
    private $societeee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProdId(): ?Produit
    {
        return $this->prodId;
    }

    public function setProdId(?Produit $prodId): self
    {
        $this->prodId = $prodId;

        return $this;
    }

    public function getFactId(): ?Facture
    {
        return $this->FactId;
    }

    public function setFactId(?Facture $FactId): self
    {
        $this->FactId = $FactId;

        return $this;
    }

    public function getDatePrevu(): ?\DateTimeInterface
    {
        return $this->datePrevu;
    }

    public function setDatePrevu(?\DateTimeInterface $datePrevu): self
    {
        $this->datePrevu = $datePrevu;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getFactureExport(): ?string
    {
        return $this->factureExport;
    }

    public function setFactureExport(?string $factureExport): self
    {
        $this->factureExport = $factureExport;

        return $this;
    }

    public function getDeclarDouane(): ?string
    {
        return $this->declarDouane;
    }

    public function setDeclarDouane(?string $declarDouane): self
    {
        $this->declarDouane = $declarDouane;

        return $this;
    }

    public function getSocieteee(): ?Societe
    {
        return $this->societeee;
    }

    public function setSocieteee(?Societe $societeee): self
    {
        $this->societeee = $societeee;

        return $this;
    }
}
