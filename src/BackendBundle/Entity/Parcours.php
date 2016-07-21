<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parcours.
 *
 * @ORM\Table(name="zboard_parcours")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\ParcoursRepository")
 */
class Parcours
{
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
     * @ORM\Column(name="libelle", type="string", length=150, unique=true)
     */
    private $libelle;

    /**
     * @var string
     * @ORM\Column(name="diplome", type="string", length=150, nullable=true)
     */
    private $diplome;

    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Abonnement", inversedBy="parcours")
     */
    private $abonnement;

    /**
     * @ORM\OneToMany(targetEntity="BackendBundle\Entity\Projet", mappedBy="parcours")
     */
    private $projet;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return Parcours
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle.
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set diplome.
     *
     * @param string $diplome
     *
     * @return Parcours
     */
    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * Get diplome.
     *
     * @return string
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * Set abonnement.
     *
     * @param \BackendBundle\Entity\Abonnement $abonnement
     *
     * @return Parcours
     */
    public function setAbonnement(\BackendBundle\Entity\Abonnement $abonnement = null)
    {
        $this->abonnement = $abonnement;

        return $this;
    }

    /**
     * Get abonnement.
     *
     * @return \BackendBundle\Entity\Abonnement
     */
    public function getAbonnement()
    {
        return $this->abonnement;
    }
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->projet = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add projet.
     *
     * @param \BackendBundle\Entity\Projet $projet
     *
     * @return Parcours
     */
    public function addProjet(\BackendBundle\Entity\Projet $projet)
    {
        $this->projet[] = $projet;

        return $this;
    }

    /**
     * Remove projet.
     *
     * @param \BackendBundle\Entity\Projet $projet
     */
    public function removeProjet(\BackendBundle\Entity\Projet $projet)
    {
        $this->projet->removeElement($projet);
    }

    /**
     * Get projet.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjet()
    {
        return $this->projet;
    }
}
