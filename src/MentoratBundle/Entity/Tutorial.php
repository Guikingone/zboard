<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tutoriel.
 *
 * @ORM\Table(name="zboard_tutorials")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\TutorialRepository")
 */
class Tutorial
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
     * @ORM\Column(name="link", type="string", length=150)
     */
    private $link;

    /**
     * @var int
     * @ORM\JoinColumn(name="category")
     * @ORM\ManyToOne(targetEntity="TutorialCategory", inversedBy="links")
     */
    private $category;

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
     * Get the value of Title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title.
     *
     * @param string title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of Link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of Link.
     *
     * @param string link
     *
     * @return self
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Set the value of Id
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
     * Get the value of Category
     *
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of Category
     *
     * @param int category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

}
