<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MentorMentore
 *
 * @ORM\Table(name="zboard_mentor_mentore")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\MentorMentoreRepository")
 */
class MentorMentore
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
     * @var \DateTime
     *
     * @ORM\Column(name="d_update", type="datetime")
     */
    private $dUpdate;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mentor;

    /**
     * @ORM\ManyToOne(targetEntity="MentoratBundle\Entity\Mentore")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mentore;

    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\StateRelationship")
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;


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
     * Set dUpdate
     *
     * @param \DateTime $dUpdate
     *
     * @return MentorMentore
     */
    public function setDUpdate($dUpdate)
    {
        $this->dUpdate = $dUpdate;

        return $this;
    }

    /**
     * Get dUpdate
     *
     * @return \DateTime
     */
    public function getDUpdate()
    {
        return $this->dUpdate;
    }

    /**
     * Set mentor
     *
     * @param \UserBundle\Entity\User $mentor
     *
     * @return MentorMentore
     */
    public function setMentor(\UserBundle\Entity\User $mentor)
    {
        $this->mentor = $mentor;

        return $this;
    }

    /**
     * Get mentor
     *
     * @return \UserBundle\Entity\User
     */
    public function getMentor()
    {
        return $this->mentor;
    }

    /**
     * Set mentore
     *
     * @param \MentoratBundle\Entity\Mentore $mentore
     *
     * @return MentorMentore
     */
    public function setMentore(\MentoratBundle\Entity\Mentore $mentore)
    {
        $this->mentore = $mentore;

        return $this;
    }

    /**
     * Get mentore
     *
     * @return \MentoratBundle\Entity\Mentore
     */
    public function getMentore()
    {
        return $this->mentore;
    }

    /**
     * Set state
     *
     * @param \BackendBundle\Entity\StateRelationship $state
     *
     * @return MentorMentore
     */
    public function setState(\BackendBundle\Entity\StateRelationship $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \BackendBundle\Entity\StateRelationship
     */
    public function getState()
    {
        return $this->state;
    }
}
