<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Soutenance
 *
 * @ORM\Table(name="soutenance")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\SoutenanceRepository")
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
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="mentor_id", referencedColumnName="id")
     */
    private $mentor_id;

    /**
     * @ORM\JoinColumn(name="mentore_id", referencedColumnName="id")
     */
    private $mentore_id;

    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Projet")
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id"))
     */
    private $projet_id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="passed_at", type="datetime")
     */
    private $passedAt;


    /**
     * Get id
     *
     * @return int
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
}

