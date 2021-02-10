<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CbRepository;
use App\Entity\Membre;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cb
 * @ORM\Entity(repositoryClass="App\Repository\CbRepository", repositoryClass=CbRepository::class)
 * @ORM\Table(name="cb", indexes={@ORM\Index(name="membre_id", columns={"membre_id"})})
 */
class Cb
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
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
     * @Assert\Length(min=1, max=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     * @Assert\Length(min=1, max=50)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255, nullable=false)
     * @Assert\Length(min=1, max=255)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", nullable=false)
     * @Assert\Length(min=5, max=5)
     */
    private $date;

    /**
     * @var Membre
     *
     * @ORM\ManyToOne(targetEntity="Membre")
     * @ORM\JoinColumns({ @ORM\JoinColumn(name="membre_id", referencedColumnName="id") })
     */
    private $membre;

    /**
     * @var string
     *
     * @ORM\Column(name="lastDigits", type="string", nullable=false)
     * @Assert\Length(min=4, max=4)
     */
    private $lastDigits;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumero(): ?string
    {
        return "**** **** **** ".$this->getLastDigits();
    }

    public function setNumero(string $numero): self
    {
        $this->numero = password_hash($numero, PASSWORD_BCRYPT, ['cost' => 12]);

        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(array $expiration): self
    {
        $this->date = $expiration[0].'/'.$expiration[1];
        return $this;
    }

    public function getLastDigits(): string
    {
        return $this->lastDigits;
    }

    public function setLastDigits($lastDigits): self
    {
        $this->lastDigits = $lastDigits;
        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(Membre $membre): self
    {
        $this->membre = $membre;
        return $this;
    }
}
