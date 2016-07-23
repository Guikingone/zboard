<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User.
 *
 * @ORM\Table(name="fos_user")
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
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastName;

    /**
     * @var string
     * @ORM\Column(name="address", type="string", length=255)
     */
    protected $address;

    /**
     * @var string
     * @ORM\Column(name="zipcode", type="string", length=255)
     */
    protected $zipcode;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", length=150)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=40)
     */
    private $phone;

    /**
     * @var bool
     * @ORM\Column(name="available", type="boolean")
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
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Competences", mappedBy="user")
     */
    private $competences;


    public function __construct()
    {
        parent::__construct();
        $this->competences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
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
     * Set country.
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
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
