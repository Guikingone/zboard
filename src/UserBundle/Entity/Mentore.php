<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Mentore.
 *
 * @ORM\Table(name="zboard_mentore")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\MentoreRepository")
 */
class Mentore extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Country", inversedBy="mentore")
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
     *
     * @ORM\Column(name="archived", type="boolean")
     */
    private $archived;

    /**
     * @ORM\OneToOne(targetEntity="MentoratBundle\Entity\Suivi", mappedBy="mentore")
     */
    private $suivi;

    /**
     * @ORM\OneToMany(targetEntity="MentoratBundle\Entity\Sessions", mappedBy="mentore")
     */
    private $sessions;

    /**
     * @ORM\OneToMany(targetEntity="MentoratBundle\Entity\Soutenance", mappedBy="mentore")
     */
    private $soutenances;

    /**
     * Mentore constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->sessions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->soutenances = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return Mentore
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
     * @return Mentore
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
     * @return Mentore
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
     * @return Mentore
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
     * @return Mentore
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
     * @return Mentore
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
     * @return Mentore
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
     * Set archived.
     *
     * @param bool $archived
     *
     * @return Mentore
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
     * Set suivi
     *
     * @param \MentoratBundle\Entity\Suivi $suivi
     *
     * @return Mentore
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
     * Set country.
     *
     * @param \AdminBundle\Entity\Country $country
     *
     * @return Mentore
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
     * Add session.
     *
     * @param \MentoratBundle\Entity\Sessions $session
     *
     * @return Mentore
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
     * @return Mentore
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
}
