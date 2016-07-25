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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="mentor_id", referencedColumnName="id")
     */
    private $mentor;

    /**
     * @ORM\ManyToOne(targetEntity="MentoratBundle\Entity\Mentore")
     * @ORM\JoinColumn(name="mentore_id", referencedColumnName="id")
     */
    private $mentore;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set passedAt.
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
     * Get passedAt.
     *
     * @return \DateTime
     */
    public function getPassedAt()
    {
        return $this->passedAt;
    }

    /**
     * Set mentor.
     *
     * @param \UserBundle\Entity\User $mentor
     *
     * @return Soutenance
     */
    public function setMentor(\UserBundle\Entity\User $mentor = null)
    {
        $this->mentor = $mentor;

        return $this;
    }

    /**
     * Get mentor.
     *
     * @return \UserBundle\Entity\User
     */
    public function getMentor()
    {
        return $this->mentor;
    }

    /**
     * Set projet.
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
     * Get projet.
     *
     * @return \BackendBundle\Entity\Projet
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * Set mentore.
     *
     * @param \MentoratBundle\Entity\Mentore $mentore
     *
     * @return Soutenance
     */
    public function setMentore(\MentoratBundle\Entity\Mentore $mentore = null)
    {
        $this->mentore = $mentore;

        return $this;
    }

    /**
     * Get mentore.
     *
     * @return \MentoratBundle\Entity\Mentore
     */
    public function getMentore()
    {
        return $this->mentore;
    }

    /**
     * Set status.
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
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
