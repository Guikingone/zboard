<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Financement.
 *
 * @ORM\Table(name="financement")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\FinancementRepository")
 */
class Financement
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
     * @var bool
     * @ORM\Column(name="is_financed", type="boolean", nullable=true)
     */
    private $isFinanced;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=255, nullable=TRUE)
     */
    private $duree;

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
     * @return Financement
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
     * Set duree.
     *
     * @param string $duree
     *
     * @return Financement
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree.
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set isFinanced.
     *
     * @param bool $isFinanced
     *
     * @return Financement
     */
    public function setIsFinanced($isFinanced)
    {
        $this->isFinanced = $isFinanced;

        return $this;
    }

    /**
     * Get isFinanced.
     *
     * @return bool
     */
    public function getIsFinanced()
    {
        return $this->isFinanced;
    }
}
