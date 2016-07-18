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
     * @ORM\OneToMany(targetEntity="BackendBundle\Entity\Projet", mappedBy="parcours")
     */
    private $projet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date", nullable=true)
     */
    private $date_start;

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
     * Set dateStart.
     *
     * @param \DateTime $dateStart
     *
     * @return Parcours
     */
    public function setDateStart($dateStart)
    {
        $this->date_start = $dateStart;

        return $this;
    }

    /**
     * Get dateStart.
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
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
