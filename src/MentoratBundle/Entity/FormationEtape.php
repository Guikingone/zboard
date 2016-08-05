<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormationEtape.
 *
 * @ORM\Table(name="zboard_formation_etapes")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\FormationEtapeRepository")
 */
class FormationEtape
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
     * @ORM\Column(name="etape", type="string", length=255)
     */
    private $etape;

    /**
     * @var bool
     *
     * @ORM\Column(name="requires_input", type="boolean")
     */
    private $requiresInput;

    /**
     * Get the value of Id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id.
     *
     * @param int id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Etape.
     *
     * @return string
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set the value of Etape.
     *
     * @param string etape
     *
     * @return self
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get the value of Requires Input.
     *
     * @return bool
     */
    public function getRequiresInput()
    {
        return $this->requiresInput;
    }

    /**
     * Set the value of Requires Input.
     *
     * @param bool requiresInput
     *
     * @return self
     */
    public function setRequiresInput($requiresInput)
    {
        $this->requiresInput = $requiresInput;

        return $this;
    }
}
