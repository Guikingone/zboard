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
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="datetime", nullable=true)
     */
    private $date_start;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="suivi")
     */
    private $users;

    /**
     * @var string
     * @ORM\Column(name="state", type="string", length=150, nullable=false)
     */
    private $suivi_state;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=100)
     */
    private $mentore_status;

    /**
     * @ORM\OneToMany(targetEntity="MentoratBundle\Entity\Notes", mappedBy="suivi")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="MentoratBundle\Entity\Sessions", mappedBy="suivi")
     */
    private $sessions;

    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Parcours", inversedBy="suivi")
     */
    private $parcours;


    /**
     * @var bool
     * @ORM\Column(name="financement", type="boolean", nullable=true)
     */
    private $financement;

    /**
     * @var string
     * @ORM\Column(name="financeur", type="string", length=150, nullable=true)
     */
    private $financeur;

    /**
     * @var string
     * @ORM\Column(name="duree_financement", type="string", length=100, nullable=true)
     */
    private $duree_financement;
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set libelle
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
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set dUpdate
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
     * Get dUpdate
     *
     * @return \DateTime
     */
    public function getDUpdate()
    {
        return $this->dUpdate;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Suivi
     */
    public function setDateStart($dateStart)
    {
        $this->date_start = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * Set suiviState
     *
     * @param string $suiviState
     *
     * @return Suivi
     */
    public function setSuiviState($suiviState)
    {
        $this->suivi_state = $suiviState;

        return $this;
    }

    /**
     * Get suiviState
     *
     * @return string
     */
    public function getSuiviState()
    {
        return $this->suivi_state;
    }

    /**
     * Set mentoreStatus
     *
     * @param string $mentoreStatus
     *
     * @return Suivi
     */
    public function setMentoreStatus($mentoreStatus)
    {
        $this->mentore_status = $mentoreStatus;

        return $this;
    }

    /**
     * Get mentoreStatus
     *
     * @return string
     */
    public function getMentoreStatus()
    {
        return $this->mentore_status;
    }

    /**
     * Set financement
     *
     * @param boolean $financement
     *
     * @return Suivi
     */
    public function setFinancement($financement)
    {
        $this->financement = $financement;

        return $this;
    }

    /**
     * Get financement
     *
     * @return boolean
     */
    public function getFinancement()
    {
        return $this->financement;
    }

    /**
     * Set financeur
     *
     * @param string $financeur
     *
     * @return Suivi
     */
    public function setFinanceur($financeur)
    {
        $this->financeur = $financeur;

        return $this;
    }

    /**
     * Get financeur
     *
     * @return string
     */
    public function getFinanceur()
    {
        return $this->financeur;
    }

    /**
     * Set dureeFinancement
     *
     * @param string $dureeFinancement
     *
     * @return Suivi
     */
    public function setDureeFinancement($dureeFinancement)
    {
        $this->duree_financement = $dureeFinancement;

        return $this;
    }

    /**
     * Get dureeFinancement
     *
     * @return string
     */
    public function getDureeFinancement()
    {
        return $this->duree_financement;
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Suivi
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
     * Add note
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
     * Remove note
     *
     * @param \MentoratBundle\Entity\Notes $note
     */
    public function removeNote(\MentoratBundle\Entity\Notes $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Add session
     *
     * @param \MentoratBundle\Entity\Sessions $session
     *
     * @return Suivi
     */
    public function addSession(\MentoratBundle\Entity\Sessions $session)
    {
        $this->sessions[] = $session;

        return $this;
    }

    /**
     * Remove session
     *
     * @param \MentoratBundle\Entity\Sessions $session
     */
    public function removeSession(\MentoratBundle\Entity\Sessions $session)
    {
        $this->sessions->removeElement($session);
    }

    /**
     * Get sessions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Set parcours
     *
     * @param \BackendBundle\Entity\Parcours $parcours
     *
     * @return Suivi
     */
    public function setParcours(\BackendBundle\Entity\Parcours $parcours = null)
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * Get parcours
     *
     * @return \BackendBundle\Entity\Parcours
     */
    public function getParcours()
    {
        return $this->parcours;
    }
}
