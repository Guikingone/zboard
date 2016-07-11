<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Informations
 *
 * @ORM\Table(name="informations_mentorat")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\InformationsRepository")
 */
class Informations
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
     * @ORM\Column(name="title", type="string", length=150)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_created", type="datetime")
     */
    private $dCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="d_updated", type="datetime", nullable=true)
     */
    private $dUpdated;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="id")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;


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
     * Set title
     *
     * @param string $title
     *
     * @return Informations
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Informations
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set dCreated
     *
     * @param \DateTime $dCreated
     *
     * @return Informations
     */
    public function setDCreated($dCreated)
    {
        $this->dCreated = $dCreated;

        return $this;
    }

    /**
     * Get dCreated
     *
     * @return \DateTime
     */
    public function getDCreated()
    {
        return $this->dCreated;
    }

    /**
     * Set dUpdated
     *
     * @param \DateTime $dUpdated
     *
     * @return Informations
     */
    public function setDUpdated($dUpdated)
    {
        $this->dUpdated = $dUpdated;

        return $this;
    }

    /**
     * Get dUpdated
     *
     * @return \DateTime
     */
    public function getDUpdated()
    {
        return $this->dUpdated;
    }

    /**
     * Set author
     *
     * @param integer $author
     *
     * @return Informations
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return int
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Informations
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}

