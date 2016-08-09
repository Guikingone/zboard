<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Country.
 *
 * @ORM\Table(name="zboard_country")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\CountryRepository")
 */
class Country
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
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="country")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Mentore", mappedBy="country")
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
     * @return Country
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
     * Add user.
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Country
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user.
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
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
     * @return Country
     */
    public function addMentore(\UserBundle\Entity\Mentore $mentore)
    {
        $this->mentores[] = $mentore;

        return $this;
    }

    /**
     * Remove mentore.
     *
     * @param \UserBundle\Entity\Mentore $mentore
     */
    public function removeMentore(\UserBundle\Entity\Mentore $mentore)
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
