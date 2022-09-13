<?php

namespace App\Entity;

use App\Repository\FactureDetailleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureDetailleRepository::class)
 */
class FactureDetaille
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Produit::class, inversedBy="factureDetaille", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $numOf;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTotal;

    /**
     * @ORM\Column(type="float")
     */
    private $chiffreAffaire;

    /**
     * @ORM\Column(type="float")
     */
    private $puTotal;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $produitName;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $refPrincipale;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteExpedie;

    /**
     * @ORM\Column(type="float")
     */
    private $pu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumOf(): ?Produit
    {
        return $this->numOf;
    }

    public function setNumOf(Produit $numOf): self
    {
        $this->numOf = $numOf;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(float $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    public function getChiffreAffaire(): ?float
    {
        return $this->chiffreAffaire;
    }

    public function setChiffreAffaire(float $chiffreAffaire): self
    {
        $this->chiffreAffaire = $chiffreAffaire;

        return $this;
    }

    public function getPuTotal(): ?float
    {
        return $this->puTotal;
    }

    public function setPuTotal(float $puTotal): self
    {
        $this->puTotal = $puTotal;

        return $this;
    }

    public function getProduitName(): ?string
    {
        return $this->produitName;
    }

    public function setProduitName(string $produitName): self
    {
        $this->produitName = $produitName;

        return $this;
    }

    public function getRefPrincipale(): ?string
    {
        return $this->refPrincipale;
    }

    public function setRefPrincipale(string $refPrincipale): self
    {
        $this->refPrincipale = $refPrincipale;

        return $this;
    }

    public function getQteExpedie(): ?int
    {
        return $this->qteExpedie;
    }

    public function setQteExpedie(int $qteExpedie): self
    {
        $this->qteExpedie = $qteExpedie;

        return $this;
    }

    public function getPu(): ?float
    {
        return $this->pu;
    }

    public function setPu(float $pu): self
    {
        $this->pu = $pu;

        return $this;
    }
}
