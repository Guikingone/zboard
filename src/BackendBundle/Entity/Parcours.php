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
     * @ORM\OneToMany(targetEntity="BackendBundle\Entity\Cours", mappedBy="parcours")
     */
    private $cours;

    /**
     * @ORM\OneToMany(targetEntity="BackendBundle\Entity\Projet", mappedBy="parcours")
     */
    private $projet;

    /**
     * @ORM\OneToMany(targetEntity="MentoratBundle\Entity\Suivi", mappedBy="parcours")
     */
    private $suivi;

    /**
     * @var boolean
     * @ORM\Column(name="archived", type="boolean")
     */
    private $archived;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->cours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projet = new \Doctrine\Common\Collections\ArrayCollection();
        $this->suivi = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add cour.
     *
     * @param \BackendBundle\Entity\Cours $cour
     *
     * @return Parcours
     */
    public function addCour(\BackendBundle\Entity\Cours $cour)
    {
        $this->cours[] = $cour;

        return $this;
    }

    /**
     * Remove cour.
     *
     * @param \BackendBundle\Entity\Cours $cour
     */
    public function removeCour(\BackendBundle\Entity\Cours $cour)
    {
        $this->cours->removeElement($cour);
    }

    /**
     * Get cours.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCours()
    {
        return $this->cours;
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

    /**
     * Add suivi.
     *
     * @param \MentoratBundle\Entity\Suivi $suivi
     *
     * @return Parcours
     */
    public function addSuivi(\MentoratBundle\Entity\Suivi $suivi)
    {
        $this->suivi[] = $suivi;

        return $this;
    }

    /**
     * Remove suivi.
     *
     * @param \MentoratBundle\Entity\Suivi $suivi
     */
    public function removeSuivi(\MentoratBundle\Entity\Suivi $suivi)
    {
        $this->suivi->removeElement($suivi);
    }

    /**
     * Get suivi.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSuivi()
    {
        return $this->suivi;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     *
     * @return Parcours
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived()
    {
        return $this->archived;
    }
}
