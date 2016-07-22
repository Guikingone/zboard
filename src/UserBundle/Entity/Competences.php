<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competences.
 *
 * @ORM\Table(name="zboard_mentors_competences")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\CompetencesRepository")
 */
class Competences
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
     * @var array
     *
     * @ORM\Column(name="libelle", type="array", nullable=true)
     */
    private $libelle;

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
     * @param array $libelle
     *
     * @return Competences
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle.
     *
     * @return array
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
}
