<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TutorialCategory.
 *
 * @ORM\Table(name="zboard_tutorial_category")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\TutorialCategoryRepository")
 */
class TutorialCategory
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Tutorial", mappedBy="category", cascade={"remove"})
     */
    private $links;

    public function __construct()
    {
        $this->links = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name.
     *
     * @param string $name
     *
     * @return TutorialCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get the value of Links.
     *
     * @return mixed
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the value of Links.
     *
     * @param mixed links
     *
     * @return self
     */
    public function setLinks($links)
    {
        $this->links = $links;

        return $this;
    }
}
