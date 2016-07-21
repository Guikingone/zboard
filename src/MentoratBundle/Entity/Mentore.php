<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mentore.
 *
 * @ORM\Table(name="zboard_mentore")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\MentoreRepository")
 */
class Mentore
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
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=25, nullable=true)
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=40, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="resume", type="text", nullable=true)
     */
    private $resume;

    /**
     * @var bool
     * @ORM\Column(name="financement", type="boolean")
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
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Parcours")
     * @ORM\JoinColumn(nullable=true)
     */
    private $parcours;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date")
     */
    private $date_start;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=100)
     */
    private $status;

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
     * Set country.
     *
     * @param int $country
     *
     * @return Mentore
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return int
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Mentore
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * Set parcours.
     *
     * @param \BackendBundle\Entity\Parcours $parcours
     *
     * @return Mentore
     */
    public function setParcours(\BackendBundle\Entity\Parcours $parcours = null)
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * Get parcours.
     *
     * @return \BackendBundle\Entity\Parcours
     */
    public function getParcours()
    {
        return $this->parcours;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Mentore
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateStart.
     *
     * @param \DateTime $dateStart
     *
     * @return Mentore
     */
    public function setDateStart($dateStart)
    {
        $this->date_start = $dateStart;

        return $this;
    }

    /**
     * Get dateStart.
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * Set abonnement.
     *
     * @param string $abonnement
     *
     * @return Mentore
     */
    public function setAbonnement($abonnement)
    {
        $this->abonnement = $abonnement;

        return $this;
    }

    /**
     * Get abonnement.
     *
     * @return string
     */
    public function getAbonnement()
    {
        return $this->abonnement;
    }

    /**
     * Set financement.
     *
     * @param bool $financement
     *
     * @return Mentore
     */
    public function setFinancement($financement)
    {
        $this->financement = $financement;

        return $this;
    }

    /**
     * Get financement.
     *
     * @return bool
     */
    public function getFinancement()
    {
        return $this->financement;
    }

    /**
     * Set financeur.
     *
     * @param string $financeur
     *
     * @return Mentore
     */
    public function setFinanceur($financeur)
    {
        $this->financeur = $financeur;

        return $this;
    }

    /**
     * Get financeur.
     *
     * @return string
     */
    public function getFinanceur()
    {
        return $this->financeur;
    }

    /**
     * Set dureeFinancement.
     *
     * @param string $dureeFinancement
     *
     * @return Mentore
     */
    public function setDureeFinancement($dureeFinancement)
    {
        $this->duree_financement = $dureeFinancement;

        return $this;
    }

    /**
     * Get dureeFinancement.
     *
     * @return string
     */
    public function getDureeFinancement()
    {
        return $this->duree_financement;
    }
}
