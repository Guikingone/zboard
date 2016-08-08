<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AbstractBundle\Model\OC\CompetencesInterface;

/**
 * Competences.
 *
 * @ORM\Table(name="zboard_projets_competences")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\CompetencesRepository")
 */
class Competences implements CompetencesInterface
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
     * @ORM\Column(name="libelle", type="text")
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Projet", inversedBy="competences")
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
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
     * @return Competences
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
     * Set projet.
     *
     * @param \BackendBundle\Entity\Projet $projet
     *
     * @return Competences
     */
    public function setProjet(\BackendBundle\Entity\Projet $projet = null)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet.
     *
     * @return \BackendBundle\Entity\Projet
     */
    public function getProjet()
    {
        return $this->projet;
    }
}
