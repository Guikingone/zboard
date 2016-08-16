<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use MentoratBundle\Entity\Candidat;
use MentoratBundle\Entity\RecrutementVote;
use MentoratBundle\Form\VoteType;
use AdminBundle\Services\Mail;
use UserBundle\Entity\User;

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
     * @var Mail
     */
    private $mail;

    /**
     * @param EntityManager $doctrine
     * @param FormFactory   $form
     * @param Session       $session
     * @param TokenStorage  $user
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, TokenStorage $user, FormFactory $form, AuthorizationCheckerInterface $authorizationChecker,Mail $mail)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->session = $session;
        $this->user = $user;
        $this->formFactory = $form;
        $this->authorizationChecker = $authorizationChecker;
        $this->mail = $mail;
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

        foreach ($allCandidatures as $candid)
        {
            $candid->countVotes();
            if ($candid->getForVotes() > 1 && $candid->getAgainstVotes() > 1)
            {
                array_push($candidaturesAArbitrer, $candid);
            }
            else
            {
                array_push($candidaturesSimple, $candid);
            }

            $candidatures['candidatures_simples'] = $candidaturesSimple;
            $candidatures['candidatures_a_arbitrer'] = $candidaturesAArbitrer;
        }

        return $candidatures;
    }

    public function getCandidature($id)
    {
        $candid = $this->doctrine->getRepository('MentoratBundle:Candidat')->find($id);
        //If the application does not exist, return null
        if(!$candid) return null;
        //Otherwise count votes and return.
        $candid->countVotes();
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

        foreach ($allCandidatures as $candid)
        {
            $candid->countVotes();
            if ($candid->getForVotes() > 1 && $candid->getAgainstVotes() > 1)
            {
                array_push($candidaturesAArbitrer, $candid);
            } else
            {
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
        $country = $this->doctrine->getRepository('AdminBundle:Country')
                                           ->findOneBy(array('libelle' => 'France'));
        $user = new User();
        $user->setUsername(strtolower($candidature->getNom()));
        $user->setFirstname($candidature->getNom());
        $user->setLastname('');
        $user->setEmail($candidature->getEmail());
        $user->setPlainPassword(strtolower($candidature->getNom()));
        $user->setAddress('');
        $user->setZipCode('');
        $user->setCity('');
        $user->setCountry($country);
        $user->setEnabled(true);
        $user->setArchived(false);
        $user->setPhone('');
        $user->setRoles(array('ROLE_MENTOR_DEBUTANT'));
        $user->setAvailable(true);
        $this->doctrine->persist($user);

        $this->doctrine->remove($candidature);

        $this->doctrine->flush();
        $this->mail->acceptApplication($candidature->getEmail(), array());

    }

    /**
     * Reject an application.
     */
    public function rejectApplication($id, $message = '')
    {
        $candidature = $this->getCandidature($id);
        $this->mail->rejectApplication($candidature->getEmail(), array());
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
    public function voteApplication($id, RecrutementVote $vote)
    {
        // Check if the user has already voted
        $currentVote = $this->doctrine->getRepository('MentoratBundle:RecrutementVote')->findBy(array('idCandidature'=>$id,'idUser' => $this->user->getToken()->getUser()->getId()));

        // If it exists, the user has already voted return null
        if($currentVote)
        {
          return null;
        }
        $vote->setIdUser($this->user->getToken()->getUser());
        $vote->setIdCandidature($this->doctrine->getRepository('MentoratBundle:Candidat')->find($id));
        $vote->setIsCandidature(true);

        $this->doctrine->persist($vote);
        $this->doctrine->flush();

        $candidature = $this->getCandidature($id);

      // Check for special operations

      // If the application has enough votes to be accepted
      if (($candidature->getForVotes() == 3 && $candidature->getAgainstVotes() == 0) || ($candidature->getForVotes() == 5 && $candidature->getAgainstVotes() == 1))
      {
          $this->acceptApplication($id);
      }
      // If the application has enough votes to be rejected
      elseif (($candidature->getAgainstVotes() == 3 && $candidature->getForVotes() == 0) || ($candidature->getAgainstVotes() == 5 && $candidature->getForVotes() == 1))
      {
          $this->rejectApplication($id);
      }
    }

    /**
    * All recruitment actions
    * @param action the action to execute
    */
    public function addVote(Request $request,$id)
    {
      $vote = new RecrutementVote();

      $form = $this->formFactory->create(VoteType::class, $vote);
      $form->handleRequest($request);

      if ($form->isValid())
      {
        // If the user is more than an MENTOR_EXPERIMENTE, his vote will be final.
        if (true === $this->authorizationChecker->isGranted('ROLE_SUPERVISEUR_MENTOR'))
        {
            if($vote->getVote()==1)
            {
                $this->acceptApplication($id,$vote);
            }
            else
            {
              $this->rejectApplication($id,$vote);
            }
            return null;
        }
        // Otherwise it's a simple vote
        else
        {
            $this->voteApplication($id,$vote);
        }
      }

      return $form;
    }
}
