<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecrutementReponse.
 *
 * @ORM\Table(name="zboard_recrutement_reponses")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\RecrutementReponseRepository")
 */
class RecrutementReponse
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
     * @ORM\JoinColumn(name="id_candidature")
     * @ORM\ManyToOne(targetEntity="Candidat", inversedBy="reponses")
     */
    private $idCandidature;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var int
     * @ORM\JoinColumn(name="id_question")
     * @ORM\ManyToOne(targetEntity="RecrutementQuestion")
     */
    private $idQuestion;

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
     * Set idCandidature.
     *
     * @param int $idCandidature
     *
     * @return RecrutementReponse
     */
    public function setIdCandidature($idCandidature)
    {
        $this->idCandidature = $idCandidature;

        return $this;
    }

    /**
     * Get idCandidature.
     *
     * @return int
     */
    public function getIdCandidature()
    {
        return $this->idCandidature;
    }

    /**
     * Set contenu.
     *
     * @param string $contenu
     *
     * @return RecrutementReponse
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu.
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set idQuestion.
     *
     * @param int $idQuestion
     *
     * @return RecrutementReponse
     */
    public function setIdQuestion($idQuestion)
    {
        $this->idQuestion = $idQuestion;

        return $this;
    }

    /**
     * Get idQuestion.
     *
     * @return int
     */
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }
}
