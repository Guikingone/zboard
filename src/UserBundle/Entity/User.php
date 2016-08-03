<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User.
 *
 * @ORM\Table(name="zboard_user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", length=11)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Informations", mappedBy="author")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;

    /**
     * @var string
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    protected $address;

    /**
     * @var string
     * @ORM\Column(name="zipcode", type="string", length=255, nullable=true)
     */
    protected $zipcode;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", length=150, nullable=true)
     */
    protected $city;

    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Country", inversedBy="users")
     */
    private $country;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=40, nullable=true)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    private $resume;

    /**
     * @var bool
     * @ORM\Column(name="available", type="boolean", nullable=true)
     */
    private $available;

    /**
     * @ORM\OneToMany(targetEntity="MentoratBundle\Entity\Suivi", mappedBy="mentor")
     */
    private $suivi;

    /**
     * @ORM\OneToMany(targetEntity="MentoratBundle\Entity\Sessions", mappedBy="mentor")
     */
    private $sessions;

    /**
     * @ORM\OneToMany(targetEntity="MentoratBundle\Entity\Soutenance", mappedBy="mentor")
     */
    private $soutenances;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Competences", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Group_User")
     * @ORM\JoinTable(name="zboard_user_group_user",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $user_groups;

    /**
     * @var bool
     * @ORM\Column(name="archived", type="boolean")
     */
    private $archived;

    /**
     * @ORM\ManyToMany(targetEntity="NotificationBundle\Entity\Events", inversedBy="users")
     * @ORM\JoinTable(name="zboard_users_events")
     */
    private $events;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->competences = new ArrayCollection();
        $this->suivi = new ArrayCollection();
        $this->soutenances = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    /**
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set address.
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipcode.
     *
     * @param string $zipcode
     *
     * @return User
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode.
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city.
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set resume.
     *
     * @param string $resume
     *
     * @return User
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume.
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set available.
     *
     * @param bool $available
     *
     * @return User
     */
    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available.
     *
     * @return bool
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set archived.
     *
     * @param bool $archived
     *
     * @return User
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived.
     *
     * @return bool
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Set country.
     *
     * @param \AdminBundle\Entity\Country $country
     *
     * @return User
     */
    public function setCountry(\AdminBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return \AdminBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add suivi.
     *
     * @param \MentoratBundle\Entity\Suivi $suivi
     *
     * @return User
     */
    public function addSuivi(\MentoratBundle\Entity\Suivi $suivi)
    {
        $this->suivi[] = $suivi;

        return $this;
    }

    /**
     * Remove suivi.
     *
     * @param \MentoratBundle\Entity\Suivi $suivi
     */
    public function removeSuivi(\MentoratBundle\Entity\Suivi $suivi)
    {
        $this->suivi->removeElement($suivi);
    }

    /**
     * Get suivi.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSuivi()
    {
        return $this->suivi;
    }

    /**
     * Add session.
     *
     * @param \MentoratBundle\Entity\Sessions $session
     *
     * @return User
     */
    public function addSession(\MentoratBundle\Entity\Sessions $session)
    {
        $this->sessions[] = $session;

        return $this;
    }

    /**
     * Remove session.
     *
     * @param \MentoratBundle\Entity\Sessions $session
     */
    public function removeSession(\MentoratBundle\Entity\Sessions $session)
    {
        $this->sessions->removeElement($session);
    }

    /**
     * Get sessions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Add soutenance.
     *
     * @param \MentoratBundle\Entity\Soutenance $soutenance
     *
     * @return User
     */
    public function addSoutenance(\MentoratBundle\Entity\Soutenance $soutenance)
    {
        $this->soutenances[] = $soutenance;

        return $this;
    }

    /**
     * Remove soutenance.
     *
     * @param \MentoratBundle\Entity\Soutenance $soutenance
     */
    public function removeSoutenance(\MentoratBundle\Entity\Soutenance $soutenance)
    {
        $this->soutenances->removeElement($soutenance);
    }

    /**
     * Get soutenances.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoutenances()
    {
        return $this->soutenances;
    }

    /**
     * Add competence.
     *
     * @param \UserBundle\Entity\Competences $competence
     *
     * @return User
     */
    public function addCompetence(\UserBundle\Entity\Competences $competence)
    {
        $this->competences[] = $competence;

        return $this;
    }

    /**
     * Remove competence.
     *
     * @param \UserBundle\Entity\Competences $competence
     */
    public function removeCompetence(\UserBundle\Entity\Competences $competence)
    {
        $this->competences->removeElement($competence);
    }

    /**
     * Get competences.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Add userGroup.
     *
     * @param \UserBundle\Entity\Group_User $userGroup
     *
     * @return User
     */
    public function addUserGroup(\UserBundle\Entity\Group_User $userGroup)
    {
        $this->user_groups[] = $userGroup;

        return $this;
    }

    /**
     * Remove userGroup.
     *
     * @param \UserBundle\Entity\Group_User $userGroup
     */
    public function removeUserGroup(\UserBundle\Entity\Group_User $userGroup)
    {
        $this->user_groups->removeElement($userGroup);
    }

    /**
     * Get userGroups.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserGroups()
    {
        return $this->user_groups;
    }

    /**
     * Add event.
     *
     * @param \NotificationBundle\Entity\Events $event
     *
     * @return User
     */
    public function addEvent(\NotificationBundle\Entity\Events $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event.
     *
     * @param \NotificationBundle\Entity\Events $event
     */
    public function removeEvent(\NotificationBundle\Entity\Events $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}
