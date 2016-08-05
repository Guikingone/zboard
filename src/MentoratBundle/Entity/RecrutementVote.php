<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecrutementVote
 *
 * @ORM\Table(name="zboard_recrutement_vote")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\RecrutementVoteRepository")
 */
class RecrutementVote
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
     * Cet id sera soit celui d'une nouvelle candidature soit celle de la formation d'un mentor
     * @ORM\JoinColumn(name="id_candidature")
     * @ORM\ManyToOne(targetEntity="Candidat", inversedBy="votes")
     */
    private $idCandidature;

    /**
     * @var bool
     * Si true c'est une candidature, si false c'est un mentor en formation
     * @ORM\Column(name="isCandidature", type="boolean")
     */
    private $isCandidature;

    /**
     * @var int
     *
     * @ORM\Column(name="vote", type="integer")
     */
    private $vote;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text")
     */
    private $commentaire;


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
     * @return RecrutementVote
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
     * Set idCandidature
     *
     * @param integer $idCandidature
     *
     * @return RecrutementVote
     */
    public function setIdCandidature($idCandidature)
    {
        $this->idCandidature = $idCandidature;

        return $this;
    }

    /**
     * Get idCandidature
     *
     * @return int
     */
    public function getIdCandidature()
    {
        return $this->idCandidature;
    }

    /**
     * Set isCandidature
     *
     * @param boolean $isCandidature
     *
     * @return RecrutementVote
     */
    public function setIsCandidature($isCandidature)
    {
        $this->isCandidature = $isCandidature;

        return $this;
    }

    /**
     * Get isCandidature
     *
     * @return bool
     */
    public function getIsCandidature()
    {
        return $this->isCandidature;
    }

    /**
     * Set vote
     *
     * @param integer $vote
     *
     * @return RecrutementVote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get vote
     *
     * @return int
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return RecrutementVote
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
}
