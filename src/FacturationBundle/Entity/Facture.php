<?php

namespace FacturationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture.
 *
 * @ORM\Table(name="zboard_mentors_facture")
 * @ORM\Entity(repositoryClass="FacturationBundle\Repository\FactureRepository")
 */
class Facture
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
     *
     * @ORM\Column(name="state", type="string", length=150, nullable=false)
     */
    private $state;

    /**
     * @ORM\Column(name="nbr_sessions", type="integer")
     */
    private $nbrSessions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_facturation", type="datetime")
     */
    private $dateFacturation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_validitee", type="datetime")
     */
    private $dateValiditee;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="factures")
     */
    private $user;

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
     * @return Facture
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
     * Set state.
     *
     * @param string $state
     *
     * @return Facture
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set nbrSessions.
     *
     * @param int $nbrSessions
     *
     * @return Facture
     */
    public function setNbrSessions($nbrSessions)
    {
        $this->nbrSessions = $nbrSessions;

        return $this;
    }

    /**
     * Get nbrSessions.
     *
     * @return int
     */
    public function getNbrSessions()
    {
        return $this->nbrSessions;
    }

    /**
     * Set dateCreation.
     *
     * @param \DateTime $dateCreation
     *
     * @return Facture
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation.
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateFacturation.
     *
     * @param \DateTime $dateFacturation
     *
     * @return Facture
     */
    public function setDateFacturation($dateFacturation)
    {
        $this->dateFacturation = $dateFacturation;

        return $this;
    }

    /**
     * Get dateFacturation.
     *
     * @return \DateTime
     */
    public function getDateFacturation()
    {
        return $this->dateFacturation;
    }

    /**
     * Set dateValiditee.
     *
     * @param \DateTime $dateValiditee
     *
     * @return Facture
     */
    public function setDateValiditee($dateValiditee)
    {
        $this->dateValiditee = $dateValiditee;

        return $this;
    }

    /**
     * Get dateValiditee.
     *
     * @return \DateTime
     */
    public function getDateValiditee()
    {
        return $this->dateValiditee;
    }

    /**
     * Set user.
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Facture
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
