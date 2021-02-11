<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\MembreRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;




//@UniqueEntity pour s'assurer que les valeurs indiqués sont unique dans la bdd'
/**
 * Membre
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository", repositoryClass=MembreRepository::class)
 * @ORM\Table(name="membre", indexes={@ORM\Index(name="pr_id", columns={"pr_id"})})
 * @UniqueEntity(
 *     fields={"email"},
 *     message= "L'email indiqué est déjà utilisé"
 * )
 * @UniqueEntity(
 *     fields={"pseudo"},
 *     message= "Le nom d'utilisateur indiqué est déjà utilisé"
 * )
 */
class Membre implements UserInterface
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
     * @ORM\Column(name="civilite", type="string", length=4, nullable=false)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=false)
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
     * @var string|null
     *
     * @ORM\Column(name="cp", type="string", length=5, nullable=true)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=150, nullable=false)
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tel", type="string", length=10, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="bloque", type="boolean", nullable=true)
     */
    private $bloque = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="pseudo", type="string", length=20, nullable=true)
     * @Assert\Length(
     *      min = 3,
     *      max = 20,
     *      minMessage = "Votre nom doit contenir un minimum de {{ limit }} caractéres",
     *      maxMessage = "Votre nom doit contenir un maximum de {{ limit }} caractéres",
     *      allowEmptyString = false
     * )
     */
    private $pseudo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;
//" @Assert\Length(min=8, minMessage = "Votre mot de passe doit contenir un minimum de {{ limit }} caractéres")"
// gére la longueur minimum du mdp et configure un message d'erreur
    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=255, nullable=false)
     * @Assert\Length(min=8,
     *      minMessage = "Votre mot de passe doit contenir un minimum de {{ limit }} caractéres")
     */
    private $mdp;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="niveau", type="boolean", nullable=true)
     */
    private $niveau;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="inscription", type="datetime", nullable=false)
     */
    private $inscription;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="desinscription", type="datetime", nullable=true)
     */
    private $desinscription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descr", type="text", length=65535, nullable=true)
     */
    private $descr;

    /**
     * @var \Pointretrait
     *
     * @ORM\ManyToOne(targetEntity="Pointretrait")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pr_id", referencedColumnName="id")
     * })
     */
    private $pr;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Recette", mappedBy="auteur")
     */
    private $recette;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", mappedBy="membre")
     */
    private $produit;

//variable servant à la confirmation des mots de passe.
//---
// "@Assert\EqualTo (propertyPath="mdp",message="Votre mot de passe et la confirmation ne correspondent pas") "
// sert à vérifier que les valeur $mdp et $confirm_password sont identiques

    /**
     * @Assert\EqualTo (propertyPath="mdp",message="Votre mot de passe et la confirmation ne correspondent pas")
     */
    public $confirm_password;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recette = new \Doctrine\Common\Collections\ArrayCollection();
        $this->produit = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inscription = new DateTime("now");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

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

    public function setCp(?string $cp): self
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

    public function setTel(?string $tel): self
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

    public function getBloque(): ?bool
    {
        return $this->bloque;
    }

    public function setBloque(?bool $bloque): self
    {
        $this->bloque = $bloque;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

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

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getNiveau(): ?bool
    {
        return $this->niveau;
    }

    public function setNiveau(?bool $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getInscription(): string
    {
        return $this->inscription->format('d-m-Y');
    }

    public function setInscription(\DateTimeInterface $inscription): self
    {
        $this->inscription = $inscription;
        return $this;
    }

    public function getDesinscription(): ?\DateTimeInterface
    {
        return $this->desinscription;
    }

    public function setDesinscription(?\DateTimeInterface $desinscription): self
    {
        $this->desinscription = $desinscription;

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

    public function getPr(): ?Pointretrait
    {
        return $this->pr;
    }

    public function setPr(?Pointretrait $pr): self
    {
        $this->pr = $pr;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getRecette(): Collection
    {
        return $this->recette;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recette->contains($recette)) {
            $this->recette[] = $recette;
            $recette->addMembre($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recette->removeElement($recette)) {
            $recette->removeMembre($this);
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
            $produit->addMembre($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produit->removeElement($produit)) {
            $produit->removeMembre($this);
        }
        return $this;
    }
//les 4 fonctions suivantes sont necessaire au module de sécurité UserInterface
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
//sert à gérer les roles de sutilisateurs
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getUsername(): ?string
    {
        return $this->pseudo;
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }
}
