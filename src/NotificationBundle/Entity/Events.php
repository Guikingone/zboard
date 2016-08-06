<?php

namespace NotificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AbstractBundle\Model\EventsInterface;
use AbstractBundle\Model\UserInterface;

/**
 * Events.
 *
 * @ORM\Table(name="zboard_events")
 * @ORM\Entity(repositoryClass="NotificationBundle\Repository\EventsRepository")
 */
class Events implements EventsInterface
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="AbstractBundle\Model\User\UserInterface")
     *
     * @var UserInterface
     */
    private $users;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Events
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
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Events
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set categorie.
     *
     * @param string $categorie
     *
     * @return Events
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie.
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add user.
     *
     * @param \AbstractBundle\Model\User\UserInterface $user
     *
     * @return Events
     */
    public function addUser(\AbstractBundle\Model\User\UserInterface $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user.
     *
     * @param \AbstractBundle\Model\User\UserInterface $user
     */
    public function removeUser(\AbstractBundle\Model\User\UserInterface $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
