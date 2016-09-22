<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use AbstractBundle\Interfaces\UserInterface;
use AdminBundle\Entity\Activity;
use FacturationBundle\Entity\Facture;
use AbstractBundle\Interfaces\CountryInterface;
use AbstractBundle\Interfaces\EventsInterface;
use Doctrine\Common\Collections\ArrayCollection;
use MentoratBundle\Entity\Notes;
use MentoratBundle\Entity\Sessions;
use MentoratBundle\Entity\Soutenance;
use MentoratBundle\Entity\Suivi;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User.
 *
 * @ORM\Table(name="zboard_user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", length=11)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Informations", mappedBy="author")
     */
    private static $id;

    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(name="zipcode", type="string", length=255, nullable=true)
     */
    private $zipcode;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", length=150, nullable=true)
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="AbstractBundle\Interfaces\CountryInterface", inversedBy="users")
     *
     * @var CountryInterface
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
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\Image(
     *     minHeight="250",
     *     maxHeight="1000",
     *     minWidth="250",
     *     maxWidth="1000"
     * )
     */
    private $profileImage;

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
     * @ORM\OneToMany(targetEntity="MentoratBundle\Entity\Notes", mappedBy="auteur")
     */
    private $notes;

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
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\UserGroup")
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
     * @ORM\ManyToMany(targetEntity="AbstractBundle\Interfaces\EventsInterface", inversedBy="users")
     * @ORM\JoinTable(name="zboard_user_events")
     *
     * @var EventsInterface
     */
    private $events;

    /**
     * @ORM\ManyToMany(targetEntity="AdminBundle\Entity\Activity", mappedBy="user")
     * @ORM\JoinTable(name="zboard_user_activity")
     */
    private $activity;

    /**
     * @ORM\OneToMany(targetEntity="FacturationBundle\Entity\Facture", mappedBy="user")
     */
    private $factures;

    /**
     * User constructor.
     *
     * @param $id
     */
    public function __construct($id)
    {
        parent::__construct();
        self::$id = $id;
        $this->competences = new ArrayCollection();
        $this->suivi = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->soutenances = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->activity = new ArrayCollection();
        $this->factures = new ArrayCollection();
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
     * @param CountryInterface|null $country
     *
     * @return $this
     */
    public function setCountry(CountryInterface $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return CountryInterface
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
    public function addSuivi(Suivi $suivi)
    {
        $this->suivi[] = $suivi;

        return $this;
    }

    /**
     * Remove suivi.
     *
     * @param \MentoratBundle\Entity\Suivi $suivi
     */
    public function removeSuivi(Suivi $suivi)
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
     * Add note.
     *
     * @param \MentoratBundle\Entity\Notes $note
     *
     * @return User
     */
    public function addNote(Notes $note)
    {
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note.
     *
     * @param \MentoratBundle\Entity\Notes $note
     */
    public function removeNote(Notes $note)
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
     * Add session.
     *
     * @param \MentoratBundle\Entity\Sessions $session
     *
     * @return User
     */
    public function addSession(Sessions $session)
    {
        $this->sessions[] = $session;

        return $this;
    }

    /**
     * Remove session.
     *
     * @param \MentoratBundle\Entity\Sessions $session
     */
    public function removeSession(Sessions $session)
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
    public function addSoutenance(Soutenance $soutenance)
    {
        $this->soutenances[] = $soutenance;

        return $this;
    }

    /**
     * Remove soutenance.
     *
     * @param \MentoratBundle\Entity\Soutenance $soutenance
     */
    public function removeSoutenance(Soutenance $soutenance)
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
    public function addCompetence(Competences $competence)
    {
        $this->competences[] = $competence;

        return $this;
    }

    /**
     * Remove competence.
     *
     * @param \UserBundle\Entity\Competences $competence
     */
    public function removeCompetence(Competences $competence)
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
     * @param \UserBundle\Entity\UserGroup $userGroup
     *
     * @return User
     */
    public function addUserGroup(UserGroup $userGroup)
    {
        $this->user_groups[] = $userGroup;

        return $this;
    }

    /**
     * Remove userGroup.
     *
     * @param \UserBundle\Entity\UserGroup $userGroup
     */
    public function removeUserGroup(UserGroup $userGroup)
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
     * @param EventsInterface $event
     *
     * @return $this
     */
    public function addEvent(EventsInterface $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * @param EventsInterface $event
     */
    public function removeEvent(EventsInterface $event)
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

    /**
     * @param $profileImage
     *
     * @return $this
     */
    public function setProfileImage($profileImage)
    {
        $this->profileImage = $profileImage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * Add activity.
     *
     * @param \AdminBundle\Entity\Activity $activity
     *
     * @return User
     */
    public function addActivity(Activity $activity)
    {
        $this->activity[] = $activity;

        return $this;
    }

    /**
     * Remove activity.
     *
     * @param \AdminBundle\Entity\Activity $activity
     */
    public function removeActivity(Activity $activity)
    {
        $this->activity->removeElement($activity);
    }

    /**
     * Get activity.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Add facture.
     *
     * @param \FacturationBundle\Entity\Facture $facture
     *
     * @return User
     */
    public function addFacture(Facture $facture)
    {
        $this->factures[] = $facture;

        return $this;
    }

    /**
     * Remove facture.
     *
     * @param \FacturationBundle\Entity\Facture $facture
     */
    public function removeFacture(Facture $facture)
    {
        $this->factures->removeElement($facture);
    }

    /**
     * Get factures.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFactures()
    {
        return $this->factures;
    }
}
