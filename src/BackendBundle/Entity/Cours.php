<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours.
 *
 * @ORM\Table(name="zboard_parcours_cours")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\CoursRepository")
 */
class Cours
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
     * @ORM\Column(name="duree", type="string", length=150, nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(name="difficulty", type="string", length=100, nullable=false)
     */
    private $difficulty;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=120, nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Parcours", inversedBy="cours")
     */
    private $parcours;

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
     * @return Cours
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
     * @return Cours
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
     * Set difficulty.
     *
     * @param string $difficulty
     *
     * @return Cours
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty.
     *
     * @return string
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Cours
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
     * @return Cours
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
}
