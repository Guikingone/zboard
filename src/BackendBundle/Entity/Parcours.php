<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parcours
 *
 * @ORM\Table(name="zboard_parcours")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\ParcoursRepository")
 */
class Parcours
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
     * @ORM\Column(name="code_parcours", type="string", length=150, unique=true)
     */
    private $codeParcours;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=150, unique=true)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date")
     */
    private $date_start;

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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Parcours
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }


    /**
     * Set codeParcours
     *
     * @param string $codeParcours
     *
     * @return Parcours
     */
    public function setCodeParcours($codeParcours)
    {
        $this->codeParcours = $codeParcours;

        return $this;
    }

    /**
     * Get codeParcours
     *
     * @return string
     */
    public function getCodeParcours()
    {
        return $this->codeParcours;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Parcours
     */
    public function setDateStart($dateStart)
    {
        $this->date_start = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }
}
