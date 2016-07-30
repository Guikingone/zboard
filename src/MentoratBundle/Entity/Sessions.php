<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sessions.
 *
 * @ORM\Table(name="zboard_suivi_sessions")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\SessionsRepository")
 */
class Sessions
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
     * @ORM\Column(name="libelle", type="string", length=200)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_session", type="datetime")
     */
    private $dateSession;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=150)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="periodicity", type="boolean")
     */
    private $periodicity;

    /**
     * @ORM\ManyToOne(targetEntity="MentoratBundle\Entity\Suivi", inversedBy="sessions")
     */
    private $suivi;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="sessions")
     */
    private $users;
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Sessions
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set dateSession
     *
     * @param \DateTime $dateSession
     *
     * @return Sessions
     */
    public function setDateSession($dateSession)
    {
        $this->dateSession = $dateSession;

        return $this;
    }

    /**
     * Get dateSession
     *
     * @return \DateTime
     */
    public function getDateSession()
    {
        return $this->dateSession;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Sessions
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set periodicity
     *
     * @param boolean $periodicity
     *
     * @return Sessions
     */
    public function setPeriodicity($periodicity)
    {
        $this->periodicity = $periodicity;

        return $this;
    }

    /**
     * Get periodicity
     *
     * @return boolean
     */
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * Set suivi
     *
     * @param \MentoratBundle\Entity\Suivi $suivi
     *
     * @return Sessions
     */
    public function setSuivi(\MentoratBundle\Entity\Suivi $suivi = null)
    {
        $this->suivi = $suivi;

        return $this;
    }

    /**
     * Get suivi
     *
     * @return \MentoratBundle\Entity\Suivi
     */
    public function getSuivi()
    {
        return $this->suivi;
    }

    /**
     * Set users
     *
     * @param \UserBundle\Entity\User $users
     *
     * @return Sessions
     */
    public function setUsers(\UserBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \UserBundle\Entity\User
     */
    public function getUsers()
    {
        return $this->users;
    }
}
