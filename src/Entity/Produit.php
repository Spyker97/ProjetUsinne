<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @UniqueEntity(fields={"refPrincipale"}, message="refPrincipale is deja exist")
 */
class Produit
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
    private $refComplete;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $numCs;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $refPrincipale;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $designation;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qteExpedie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tempsGamme;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datePrevu;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tempsFacture;

    /**
     * @ORM\Column(type="float")
     */
    private $PU;

    /**
     * @ORM\ManyToOne(targetEntity=ProduitName::class, inversedBy="produits")
     */
    private $produitName;

    /**
     * @ORM\Column(type="float")
     */
    private $volume;

    /**
     * @ORM\Column(type="float")
     */
    private $poid;

    /**
     * @ORM\OneToOne(targetEntity=FactureDetaille::class, mappedBy="numOf", cascade={"persist", "remove"})
     */
    private $factureDetaille;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Remarque;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $colisage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefComplete(): ?string
    {
        return $this->refComplete;
    }

    public function setRefComplete(string $refComplete): self
    {
        $this->refComplete = $refComplete;

        return $this;
    }

    public function getNumCs(): ?string
    {
        return $this->numCs;
    }

    public function setNumCs(?string $numCs): self
    {
        $this->numCs = $numCs;

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

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

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

    public function getQteExpedie(): ?int
    {
        return $this->qteExpedie;
    }

    public function setQteExpedie(?int $qteExpedie): self
    {
        $this->qteExpedie = $qteExpedie;

        return $this;
    }

    public function getTempsGamme(): ?float
    {
        return $this->tempsGamme;
    }

    public function setTempsGamme(?float $tempsGamme): self
    {
        $this->tempsGamme = $tempsGamme;

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

    public function getTempsFacture(): ?float
    {
        return $this->tempsFacture;
    }

    public function setTempsFacture(?float $tempsFacture): self
    {
        $this->tempsFacture = $tempsFacture;

        return $this;
    }

    public function getPU(): ?float
    {
        return $this->PU;
    }

    public function setPU(float $PU): self
    {
        $this->PU = $PU;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addConstraint(new UniqueEntity([
            'fields' => ['refComplete'],
            'errorPath' =>'refComplete',
            'message' => 'This refComplete  is already in use on that host.',
        ]));
    }

    public function getProduitName(): ?ProduitName
    {
        return $this->produitName;
    }

    public function setProduitName(?ProduitName $produitName): self
    {
        $this->produitName = $produitName;

        return $this;
    }

    public function getVolume(): ?float
    {
        return $this->volume;
    }

    public function setVolume(float $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getPoid(): ?float
    {
        return $this->poid;
    }

    public function setPoid(float $poid): self
    {
        $this->poid = $poid;

        return $this;
    }

    public function getFactureDetaille(): ?FactureDetaille
    {
        return $this->factureDetaille;
    }

    public function setFactureDetaille(FactureDetaille $factureDetaille): self
    {
        // set the owning side of the relation if necessary
        if ($factureDetaille->getNumOf() !== $this) {
            $factureDetaille->setNumOf($this);
        }

        $this->factureDetaille = $factureDetaille;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->Remarque;
    }

    public function setRemarque(?string $Remarque): self
    {
        $this->Remarque = $Remarque;

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


}
