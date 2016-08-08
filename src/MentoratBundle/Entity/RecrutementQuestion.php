<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecrutementQuestion
 *
 * @ORM\Table(name="zboard_recrutement_questions")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\RecrutementQuestionRepository")
 */
class RecrutementQuestion
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
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="type_answer", type="string", length=255)
     */
    private $typeAnswer;

    


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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return RecrutementQuestion
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set typeAnswer
     *
     * @param string $typeAnswer
     *
     * @return RecrutementQuestion
     */
    public function setTypeAnswer($typeAnswer)
    {
        $this->typeAnswer = $typeAnswer;

        return $this;
    }

    /**
     * Get typeAnswer
     *
     * @return string
     */
    public function getTypeAnswer()
    {
        return $this->typeAnswer;
    }
}
