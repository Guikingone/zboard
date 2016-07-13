<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="zboard_projet")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\ProjetRepository")
 */
class Projet
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
     * @ORM\Column(name="libelle_projet", type="string", length=255)
     */
    private $libelleProjet;

    /**
     * @ORM\ManyToOne(targetEntity="MentoratBundle\Entity\Parcours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parcours;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelleProjet
     *
     * @param string $libelleProjet
     *
     * @return Projet
     */
    public function setLibelleProjet($libelleProjet)
    {
        $this->libelleProjet = $libelleProjet;

        return $this;
    }

    /**
     * Get libelleProjet
     *
     * @return string
     */
    public function getLibelleProjet()
    {
        return $this->libelleProjet;
    }


    /**
     * Set projet
     *
     * @param \MentoratBundle\Entity\Parcours $parcours
     *
     * @return Parcours
     */
    public function setParcours(\MentoratBundle\Entity\Parcours $parcours)
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \MentoratBundle\Entity\Parcours
     */
    public function getParcours()
    {
        return $this->parcours;
    }
}

