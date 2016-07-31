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
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="soutenances")
     */
    private $mentor;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Mentore", inversedBy="soutenances")
     */
    private $mentore;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mentor = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add mentor
     *
     * @param \UserBundle\Entity\User $mentor
     *
     * @return Soutenance
     */
    public function addMentor(\UserBundle\Entity\User $mentor)
    {
        $this->mentor[] = $mentor;

        return $this;
    }

    /**
     * Remove mentor
     *
     * @param \UserBundle\Entity\User $mentor
     */
    public function removeMentor(\UserBundle\Entity\User $mentor)
    {
        $this->mentor->removeElement($mentor);
    }

    /**
     * Get mentor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMentor()
    {
        return $this->mentor;
    }

    /**
     * Set mentore
     *
     * @param \UserBundle\Entity\Mentore $mentore
     *
     * @return Soutenance
     */
    public function setMentore(\UserBundle\Entity\Mentore $mentore = null)
    {
        $this->mentore = $mentore;

        return $this;
    }

    /**
     * Get mentore
     *
     * @return \UserBundle\Entity\Mentore
     */
    public function getMentore()
    {
        return $this->mentore;
    }
}
