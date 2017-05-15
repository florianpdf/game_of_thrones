<?php

namespace GameOfThronesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personnage
 *
 * @ORM\Table(name="personnage")
 * @ORM\Entity(repositoryClass="GameOfThronesBundle\Repository\PersonnageRepository")
 */
class Personnage
{
    /**
     * @var Royaume
     *
     * @ORM\ManyToOne(targetEntity="Royaume", inversedBy="personnages")
     */
    private $royaume;
//
//    public function __toString()
//    {
//        $str =
//            'Nom: ' . $this->nom .
//            '<br>Prenom: ' . $this->prenom .
//            '<br>Sexe: ' . $this->sexe .
//            '<br>Biographie: ' . $this->bio .
//            '<br>Royaume: <br><ul>' . $this->royaume .
//            "</ul>";
//        return $str;
//    }

    // Generated

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="bio", type="string", length=255)
     */
    private $bio;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Personnage
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Personnage
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Personnage
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return Personnage
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set royaume
     *
     * @param \GameOfThronesBundle\Entity\Royaume $royaume
     *
     * @return Personnage
     */
    public function setRoyaume(\GameOfThronesBundle\Entity\Royaume $royaume = null)
    {
        $this->royaume = $royaume;

        return $this;
    }

    /**
     * Get royaume
     *
     * @return \GameOfThronesBundle\Entity\Royaume
     */
    public function getRoyaume()
    {
        return $this->royaume;
    }
}
