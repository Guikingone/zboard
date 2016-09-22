<?php

namespace NotificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AbstractBundle\Interfaces\EventsInterface;
use UserBundle\Entity\Mentore;
use UserBundle\Entity\User;

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
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="events")
     * @ORM\JoinTable(name="zboard_user_events")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Mentore", mappedBy="events")
     * @ORM\JoinTable(name="zboard_mentore_events")
     */
    private $mentores;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->mentores = new ArrayCollection();
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
     * @param \UserBundle\Entity\User $user
     *
     * @return Events
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user.
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(User $user)
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

    /**
     * Add mentore.
     *
     * @param \UserBundle\Entity\Mentore $mentore
     *
     * @return Events
     */
    public function addMentore(Mentore $mentore)
    {
        $this->mentores[] = $mentore;

        return $this;
    }

    /**
     * Remove mentore.
     *
     * @param \UserBundle\Entity\Mentore $mentore
     */
    public function removeMentore(Mentore $mentore)
    {
        $this->mentores->removeElement($mentore);
    }

    /**
     * Get mentores.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMentores()
    {
        return $this->mentores;
    }
}
