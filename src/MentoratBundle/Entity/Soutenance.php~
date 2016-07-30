<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Soutenance.
 *
 * @ORM\Table(name="zboard_suivi_soutenance")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\SoutenanceRepository")
 */
class Soutenance
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
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="soutenances")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Projet")
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id"))
     */
    private $projet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="passed_at", type="datetime", nullable=true)
     */
    private $passedAt;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set passedAt
     *
     * @param \DateTime $passedAt
     *
     * @return Soutenance
     */
    public function setPassedAt($passedAt)
    {
        $this->passedAt = $passedAt;

        return $this;
    }

    /**
     * Get passedAt
     *
     * @return \DateTime
     */
    public function getPassedAt()
    {
        return $this->passedAt;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Soutenance
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
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Soutenance
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set projet
     *
     * @param \BackendBundle\Entity\Projet $projet
     *
     * @return Soutenance
     */
    public function setProjet(\BackendBundle\Entity\Projet $projet = null)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \BackendBundle\Entity\Projet
     */
    public function getProjet()
    {
        return $this->projet;
    }
}
