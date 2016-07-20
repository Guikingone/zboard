<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notes.
 *
 * @ORM\Table(name="notes")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\NotesRepository")
 */
class Notes
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
     * @ORM\Column(name="libelle", type="text")
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="MentoratBundle\Entity\Suivi",inversedBy="notes")
     * @ORM\JoinColumn(name="suivi_id", referencedColumnName="id")
     */
    private $suivi;

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
     * @return Notes
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
     * Set dateCreated.
     *
     * @param \DateTime $dateCreated
     *
     * @return Notes
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated.
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set suivi.
     *
     * @param \MentoratBundle\Entity\Suivi $suivi
     *
     * @return Notes
     */
    public function setSuivi(\MentoratBundle\Entity\Suivi $suivi = null)
    {
        $this->suivi = $suivi;

        return $this;
    }

    /**
     * Get suivi.
     *
     * @return \MentoratBundle\Entity\Suivi
     */
    public function getSuivi()
    {
        return $this->suivi;
    }
}
