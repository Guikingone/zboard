<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet.
 *
 * @ORM\Table(name="zboard_parcours_projet")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\ProjetRepository")
 */
class Projet
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     * @ORM\Column(name="duree", type="string", length=100, nullable=true)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=120, nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Parcours", inversedBy="projet")
     * @ORM\JoinColumn(name="parcours_id", referencedColumnName="id")
     */
    private $parcours;

    /**
     * @ORM\OneToMany(targetEntity="BackendBundle\Entity\Competences", mappedBy="projet")
     */
    private $competences;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->competences = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Projet
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
     * Set duree.
     *
     * @param string $duree
     *
     * @return Projet
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree.
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Projet
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set parcours.
     *
     * @param \BackendBundle\Entity\Parcours $parcours
     *
     * @return Projet
     */
    public function setParcours(\BackendBundle\Entity\Parcours $parcours = null)
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * Get parcours.
     *
     * @return \BackendBundle\Entity\Parcours
     */
    public function getParcours()
    {
        return $this->parcours;
    }

    /**
     * Add competence.
     *
     * @param \BackendBundle\Entity\Competences $competence
     *
     * @return Projet
     */
    public function addCompetence(\BackendBundle\Entity\Competences $competence)
    {
        $this->competences[] = $competence;

        return $this;
    }

    /**
     * Remove competence.
     *
     * @param \BackendBundle\Entity\Competences $competence
     */
    public function removeCompetence(\BackendBundle\Entity\Competences $competence)
    {
        $this->competences->removeElement($competence);
    }

    /**
     * Get competences.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetences()
    {
        return $this->competences;
    }
}
