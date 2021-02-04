<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FournisseurRepository;

/**
 * Fournisseur
 * @ORM\Entity(repositoryClass="App\Repository\FournisseurRepository", repositoryClass=FournisseurRepository::class)
 * @ORM\Table(name="fournisseur", indexes={@ORM\Index(name="comm_id", columns={"comm_id"})})
 */
class Fournisseur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=150, nullable=false)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse1", type="string", length=200, nullable=true)
     */
    private $adresse1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse2", type="string", length=200, nullable=true)
     */
    private $adresse2;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=5, nullable=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=100, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=10, nullable=false)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descr", type="text", length=65535, nullable=true)
     */
    private $descr;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comm_id", referencedColumnName="id")
     * })
     */
    private $comm;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Pointretrait", inversedBy="four")
     * @ORM\JoinTable(name="livrer",
     *   joinColumns={
     *     @ORM\JoinColumn(name="four_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pr_id", referencedColumnName="id")
     *   }
     * )
     */
    private $pr;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pr = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse1(): ?string
    {
        return $this->adresse1;
    }

    public function setAdresse1(?string $adresse1): self
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    public function getAdresse2(): ?string
    {
        return $this->adresse2;
    }

    public function setAdresse2(?string $adresse2): self
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(?string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }

    public function getComm(): ?Commercial
    {
        return $this->comm;
    }

    public function setComm(?Commercial $comm): self
    {
        $this->comm = $comm;

        return $this;
    }

    /**
     * @return Collection|Pointretrait[]
     */
    public function getPr(): Collection
    {
        return $this->pr;
    }

    public function addPr(Pointretrait $pr): self
    {
        if (!$this->pr->contains($pr)) {
            $this->pr[] = $pr;
        }

        return $this;
    }

    public function removePr(Pointretrait $pr): self
    {
        $this->pr->removeElement($pr);

        return $this;
    }

}
