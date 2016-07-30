<?php

namespace UserBundle\Entity;

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
     * @ORM\ManyToOne(targetEntity="MentoratBundle\Entity\Suivi", inversedBy="users", cascade={ "persist", "remove" })
     */
    private $suivi;

    /**
     * @ORM\ManyToOne(targetEntity="MentoratBundle\Entity\Sessions", inversedBy="users")
     */
    private $sessions;

    /**
     * @ORM\ManyToOne(targetEntity="MentoratBundle\Entity\Soutenance", inversedBy="users")
     */
    private $soutenances;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Competences", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $competences;

    /**
     * @var boolean
     * @ORM\Column(name="archived", type="boolean")
     */
    private $archived;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->competences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set firstname
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
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
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
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set address
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
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipcode
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
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city
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
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone
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
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set resume
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
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set available
     *
     * @param boolean $available
     *
     * @return User
     */
    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return boolean
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     *
     * @return User
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Set country
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
     * Get country
     *
     * @return \AdminBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set suivi
     *
     * @param \MentoratBundle\Entity\Suivi $suivi
     *
     * @return User
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
     * Set sessions
     *
     * @param \MentoratBundle\Entity\Sessions $sessions
     *
     * @return User
     */
    public function setSessions(\MentoratBundle\Entity\Sessions $sessions = null)
    {
        $this->sessions = $sessions;

        return $this;
    }

    /**
     * Get sessions
     *
     * @return \MentoratBundle\Entity\Sessions
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Set soutenances
     *
     * @param \MentoratBundle\Entity\Soutenance $soutenances
     *
     * @return User
     */
    public function setSoutenances(\MentoratBundle\Entity\Soutenance $soutenances = null)
    {
        $this->soutenances = $soutenances;

        return $this;
    }

    /**
     * Get soutenances
     *
     * @return \MentoratBundle\Entity\Soutenance
     */
    public function getSoutenances()
    {
        return $this->soutenances;
    }

    /**
     * Add competence
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
     * Remove competence
     *
     * @param \UserBundle\Entity\Competences $competence
     */
    public function removeCompetence(\UserBundle\Entity\Competences $competence)
    {
        $this->competences->removeElement($competence);
    }

    /**
     * Get competences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetences()
    {
        return $this->competences;
    }
}
