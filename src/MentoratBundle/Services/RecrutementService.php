<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
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
     * Donne les candidatures.
     *
     * @return array with all applications
     */
    public function getCandidatures()
    {
      $candidatures = array();
      $candidaturesSimple = array();
      $candidaturesAArbitrer = array();

      $allCandidatures = $this->doctrine->getRepository('MentoratBundle:Candidat')->findBy(array('isCandidature'=>true));

      foreach($allCandidatures as $candid)
      {
        $candid->countVotes();
        if($candid->getForVotes()>1&&$candid->getAgainstVotes()>1)
        {
          array_push($candidaturesAArbitrer,$candid);
        }
        else
        {
          array_push($candidaturesSimple,$candid);
        }

        $candidatures['candidatures_simples'] = $candidaturesSimple;
        $candidatures['candidatures_a_arbitrer'] = $candidaturesAArbitrer;

        return $candidatures;
    }

    public function getCandidature($id)
    {
      $candid = $this->doctrine->getRepository('MentoratBundle:Candidat')->find($id);
      $candid->countVotes($candid);
      return $candid;
    }

    /**
     * Donne les candidatures des mentors débutants
     * @return array with all applications
     */
    public function getFormationCandidatures()
    {
      $candidatures = array();
      $candidaturesSimple = array();
      $candidaturesAArbitrer = array();

      $allCandidatures = $this->doctrine->getRepository('MentoratBundle:Candidat')->findBy(array("isCandidature"=>false));

      foreach($allCandidatures as $candid)
      {
        $candid->countVotes();
        if($candid->getForVotes()>1&&$candid->getAgainstVotes()>1)
        {
          array_push($candidaturesAArbitrer,$candid);
        }
        else
        {
          array_push($candidaturesSimple,$candid);
        }
      }

      $candidatures['candidatures_simples'] = $candidaturesSimple;
      $candidatures['candidatures_a_arbitrer'] = $candidaturesAArbitrer;

      return $candidatures;
    }

        return $candid;
    }
}
