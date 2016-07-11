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
}

