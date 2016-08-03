<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormationEtapeUser
 *
 * @ORM\Table(name="zboard_formation_etape_user")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\FormationEtapeUserRepository")
 */
class FormationEtapeUser
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
     * @var int
     * @ORM\ManyToOne(targetEntity="UserBundle/Entity/User")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(name="id_user", type="integer")
     */
    private $idUser;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="MentoratBundle/Entity/FormationEtape")
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Column(name="id_etape", type="integer")
     */
    private $idEtape;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=true)
     */
    private $content;


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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return FormationEtapeUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return FormationEtapeUser
     */
    public function setIdEtape($idEtape)
    {
        $this->idEtape = $idEtape;

        return $this;
    }

    /**
     * Get idEtape
     *
     * @return int
     */
    public function getIdEtape()
    {
        return $this->idEtape;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return FormationEtapeUser
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
