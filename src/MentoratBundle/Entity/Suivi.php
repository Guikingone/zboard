<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Suivi.
 *
 * @ORM\Table(name="zboard_suivi")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\SuiviRepository")
 */
class Suivi
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
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_update", type="datetime", nullable=true)
     */
    private $dUpdate;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="suivi")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mentor;

    /**
     * @ORM\OneToOne(targetEntity="MentoratBundle\Entity\Mentore", inversedBy="suivi")
     */
    private $mentore;

    /**
     * @var string
     * @ORM\Column(name="state", type="string", length=150, nullable=false)
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity="MentoratBundle\Entity\Notes", mappedBy="suivi")
     */
    private $notes;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Suivi
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
     * Set dUpdate.
     *
     * @param \DateTime $dUpdate
     *
     * @return Suivi
     */
    public function setDUpdate($dUpdate)
    {
        $this->dUpdate = $dUpdate;

        return $this;
    }

    /**
     * Get dUpdate.
     *
     * @return \DateTime
     */
    public function getDUpdate()
    {
        return $this->dUpdate;
    }

    /**
     * Set mentor.
     *
     * @param \UserBundle\Entity\User $mentor
     *
     * @return Suivi
     */
    public function setMentor(\UserBundle\Entity\User $mentor)
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
     * Set mentore.
     *
     * @param \MentoratBundle\Entity\Mentore $mentore
     *
     * @return Suivi
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
     * Add note.
     *
     * @param \MentoratBundle\Entity\Notes $note
     *
     * @return Suivi
     */
    public function addNote(\MentoratBundle\Entity\Notes $note)
    {
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note.
     *
     * @param \MentoratBundle\Entity\Notes $note
     */
    public function removeNote(\MentoratBundle\Entity\Notes $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set state.
     *
     * @param string $state
     *
     * @return Suivi
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
}
