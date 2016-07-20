<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnement.
 *
 * @ORM\Table(name="abonnement")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\AbonnementRepository")
 */
class Abonnement
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
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=255)
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity="BackendBundle\Entity\Parcours", mappedBy="abonnement")
     */
    private $parcours;

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
     * @return Abonnement
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
     * Set prix.
     *
     * @param string $prix
     *
     * @return Abonnement
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix.
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parcours = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add parcour
     *
     * @param \BackendBundle\Entity\Parcours $parcour
     *
     * @return Abonnement
     */
    public function addParcour(\BackendBundle\Entity\Parcours $parcour)
    {
        $this->parcours[] = $parcour;

        return $this;
    }

    /**
     * Remove parcour
     *
     * @param \BackendBundle\Entity\Parcours $parcour
     */
    public function removeParcour(\BackendBundle\Entity\Parcours $parcour)
    {
        $this->parcours->removeElement($parcour);
    }

    /**
     * Get parcours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParcours()
    {
        return $this->parcours;
    }
}
