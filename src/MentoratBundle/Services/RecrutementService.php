<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use MentoratBundle\Entity\Candidat;
use MentoratBundle\Entity\RecrutementVote;

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

        $allCandidatures = $this->doctrine->getRepository('MentoratBundle:Candidat')->findBy(array('isCandidature' => true));

        foreach ($allCandidatures as $candid) {
            $candid->countVotes();
            if ($candid->getForVotes() > 1 && $candid->getAgainstVotes() > 1) {
                array_push($candidaturesAArbitrer, $candid);
            } else {
                array_push($candidaturesSimple, $candid);
            }

            $candidatures['candidatures_simples'] = $candidaturesSimple;
            $candidatures['candidatures_a_arbitrer'] = $candidaturesAArbitrer;
        }
        return new Redirect

        return $candidatures;
    }

    public function getCandidature($id)
    {
        $candid = $this->doctrine->getRepository('MentoratBundle:Candidat')->find($id);
        $candid->countVotes($candid);

        return $candid;
    }

    /**
     * Donne les candidatures des mentors débutants.
     *
     * @return array with all applications
     */
    public function getFormationCandidatures()
    {
        $candidatures = array();
        $candidaturesSimple = array();
        $candidaturesAArbitrer = array();

        $allCandidatures = $this->doctrine->getRepository('MentoratBundle:Candidat')->findBy(array('isCandidature' => false));

        foreach ($allCandidatures as $candid) {
            $candid->countVotes();
            if ($candid->getForVotes() > 1 && $candid->getAgainstVotes() > 1) {
                array_push($candidaturesAArbitrer, $candid);
            } else {
                array_push($candidaturesSimple, $candid);
            }
        }

        $candidatures['candidatures_simples'] = $candidaturesSimple;
        $candidatures['candidatures_a_arbitrer'] = $candidaturesAArbitrer;

        return $candidatures;
    }

    /**
     * Accept an application.
     */
    public function acceptApplication($id, $message = '')
    {
        $candidature = $this->getCandidature($id);
    }

    /**
     * Reject an application.
     */
    public function rejectApplication($id, $message = '')
    {
        $candidature = $this->getCandidature($id);
        $this->get('admin.mail')->rejectApplication($candidature->getEmail(), array());
        $this->doctrine->remove($candidature);
        $this->doctrine->flush();
    }

    /**
     * Vote for or against an application.
     *
     * @param $id
     * @param bool $isForVote, true if it is a for vote, false otherwise
     * @param $commentaire
     */
    public function voteApplication($id, boolean $isForVote, $commentaire)
    {
        $vote = new RecrutementVote();
        $vote->setIdUser($this->user->getToken()->getUser());
        $vote->setIdCandidature($this->doctrine->getRepository('MentoratBundle:Candidat')->find($id));
        $vote->setIsCandidature(true);
        $vote->setCommentaire($commentaire);
        if ($isForVote) {
            $vote->setVote(1);
        } else {
            $vote->setVote(-1);
        }
        $this->doctrine->persist($vote);
        $this->doctrine->flush();

        $candidature = $this->getCandidature($id);

      // Check for special operations

      // If the application has enough votes to be accepted
      if (($candidature->getForVotes() == 3 && $candidature->getAgainstVotes() == 0) || ($candidature->getForVotes() == 5 && $candidature->getAgainstVotes() == 1)) {
          $this->acceptApplication($id);
      }
      // If the application has enough votes to be rejected
      elseif (($candidature->getAgainstVotes() == 3 && $candidature->getForVotes() == 0) || ($candidature->getAgainstVotes() == 5 && $candidature->getForVotes() == 1)) {
          $this->rejectApplication($id);
      }
    }
}
