<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecrutementVote.
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user")
     */
    private $idUser;

    /**
     * @var int
     *          Cet id sera soit celui d'une nouvelle candidature soit celle de la formation d'un mentor
     * @ORM\JoinColumn(name="candidature")
     * @ORM\ManyToOne(targetEntity="Candidat", inversedBy="votes")
     */
    private $candidature;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set vote.
     *
     * @param int $vote
     *
     * @return RecrutementVote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get vote.
     *
     * @return int
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set commentaire.
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
     * Get commentaire.
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set idUser.
     *
     * @param \UserBundle\Entity\User $idUser
     *
     * @return RecrutementVote
     */
    public function setIdUser(\UserBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser.
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set candidature.
     *
     * @param \MentoratBundle\Entity\Candidat $candidature
     *
     * @return RecrutementVote
     */
    public function setCandidature(\MentoratBundle\Entity\Candidat $candidature = null)
    {
        $this->candidature = $candidature;

        return $this;
    }

    /**
     * Get candidature.
     *
     * @return \MentoratBundle\Entity\Candidat
     */
    public function getCandidature()
    {
        return $this->candidature;
    }
}
