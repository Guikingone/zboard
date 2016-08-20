<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotNull()
     */
    protected $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=255)
     * @Assert\NotNull()
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
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Country", inversedBy="mentores")
     * @Assert\NotNull()
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
     *     maxHeight="250"
     * )
     */
    private $profileImage;

    /**
     * @var bool
     *
     * @ORM\Column(name="archived", type="boolean")
     */
    private $archived;

    /**
     * @var boolean
     *
     * @ORM\Column(name="available", type="boolean")
     */
    private $available;

    /**
     * @ORM\OneToOne(targetEntity="MentoratBundle\Entity\Suivi", mappedBy="mentore", cascade={ "persist", "remove" })
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
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\UserGroup")
     * @ORM\JoinTable(name="zboard_mentore_group_user",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @ORM\ManyToMany(targetEntity="NotificationBundle\Entity\Events", inversedBy="mentores")
     */
    private $events;

    /**
     * Set firstname
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
     * @return Mentore
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
     * @return Mentore
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
     * @return Mentore
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
     * @return Mentore
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
     * @return Mentore
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
     * @return Mentore
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
     * Set profileImage
     *
     * @param string $profileImage
     *
     * @return Mentore
     */
    public function setProfileImage($profileImage)
    {
        $this->profileImage = $profileImage;

        return $this;
    }

    /**
     * Get profileImage
     *
     * @return string
     */
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     *
     * @return Mentore
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
     * Set available
     *
     * @param boolean $available
     *
     * @return Mentore
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
     * Set country
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
     * Add session
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
     * Add soutenance
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
     * Remove soutenance
     *
     * @param \MentoratBundle\Entity\Soutenance $soutenance
     */
    public function removeSoutenance(\MentoratBundle\Entity\Soutenance $soutenance)
    {
        $this->soutenances->removeElement($soutenance);
    }

    /**
     * Get soutenances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoutenances()
    {
        return $this->soutenances;
    }

    /**
     * Add event
     *
     * @param \NotificationBundle\Entity\Events $event
     *
     * @return Mentore
     */
    public function addEvent(\NotificationBundle\Entity\Events $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \NotificationBundle\Entity\Events $event
     */
    public function removeEvent(\NotificationBundle\Entity\Events $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }
}
