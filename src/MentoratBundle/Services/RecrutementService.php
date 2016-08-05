<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class RecrutementService
{
    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * @var FormFactory
     */
    protected $form;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var TokenStorage
     */
    private $user;

    /**
   * @param EntityManager $doctrine
   * @param FormFactory   $form
   * @param Session       $session
   * @param TokenStorage  $user
   */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, TokenStorage $user)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->session = $session;
        $this->user = $user;
    }

    /**
     * Donne les candidatures
     * @return array with all applications
     */
    public function getCandidatures()
    {
      $candidatures = array();
      $candidaturesSimple = array();
      $candidaturesAArbitrer = array();

      $allCandidatures = $this->doctrine->getRepository('MentoratBundle:Candidat')->findAll();

      foreach($allCandidatures as $candid)
      {
        $votes_for = 0;
        $votes_against = 0;
        foreach($candid->getVotes() as $vote)
        {
          if($vote->getVote() == 1)
          {
            $votes_for++;
          }
          else
          {
            $votes_against++;
          }
        }
        if($votes_for>1&&$votes_against>1)
        {
          array_push($candidaturesAArbitrer,array("candidature"=>$candid,"votes_for"=>$votes_for,"votes_against"=>$votes_against));
        }
        else
        {
          array_push($candidaturesSimple,array("candidature"=>$candid,"votes_for"=>$votes_for,"votes_against"=>$votes_against));
        }
      }

      $candidatures['candidatures_simples'] = $candidaturesSimple;
      $candidatures['candidatures_a_arbitrer'] = $candidaturesAArbitrer;

      return $candidatures;
    }
}

?>
