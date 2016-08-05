<?php

namespace MentoratBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Candidat.
 *
 * @ORM\Table(name="zboard_candidatures")
 * @ORM\Entity(repositoryClass="MentoratBundle\Repository\CandidatRepository")
 */
class Candidat
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
     * @ORM\Column(name="nom", type="string", length=50)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCandidature", type="datetime")
     */
    private $dateCandidature;

    /**
     * @var array
     *
     * @ORM\Column(name="competences", type="array")
     */
    private $competences;

    /**
     * @var string
     *
     * @ORM\Column(name="motivation", type="text")
     */
    private $motivation;

    /**
     * @ORM\OneToMany(targetEntity="RecrutementVote", mappedBy="idCandidature")
     */
     protected $votes;

     protected $forVotes;
     protected $againstVotes;

     public function __construct()
     {
       $this->votes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom.
     *
     * @param string $nom
     *
     * @return Candidat
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Candidat
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateCandidature.
     *
     * @param \DateTime $dateCandidature
     *
     * @return Candidat
     */
    public function setDateCandidature($dateCandidature)
    {
        $this->dateCandidature = $dateCandidature;

        return $this;
    }

    /**
     * Get dateCandidature.
     *
     * @return \DateTime
     */
    public function getDateCandidature()
    {
        return $this->dateCandidature;
    }

    /**
     * Set competences.
     *
     * @param array $competences
     *
     * @return Candidat
     */
    public function setCompetences($competences)
    {
        $this->competences = $competences;

        return $this;
    }

    /**
     * Get competences.
     *
     * @return array
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Set motivation.
     *
     * @param string $motivation
     *
     * @return Candidat
     */
    public function setMotivation($motivation)
    {
        $this->motivation = $motivation;

        return $this;
    }

    /**
     * Get motivation.
     *
     * @return string
     */
    public function getMotivation()
    {
        return $this->motivation;
    }


    /**
     * Get the value of Votes
     *
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    public function countVotes()
    {
      $this->forVotes = 0;
      $this->againstVotes = 0;
      foreach($this->getVotes() as $vote)
      {
        if($vote->getVote() == 1)
        {
          $this->forVotes++;
        }
        else
        {
          $this->againstVotes++;
        }
      }
      return;
    }


    /**
     * Get the value of For Votes
     *
     * @return mixed
     */
    public function getForVotes()
    {
        return $this->forVotes;
    }

    /**
     * Get the value of Against Votes
     *
     * @return mixed
     */
    public function getAgainstVotes()
    {
        return $this->againstVotes;
    }

}
