<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 * (c) Christophe Lablancherie <c.lablancherie@live.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Notes;
use MentoratBundle\Entity\Sessions;
use MentoratBundle\Entity\Soutenance;
use MentoratBundle\Form\Type\Add\NoteAddType;
use MentoratBundle\Form\Type\Add\SoutenanceAddType;
use MentoratBundle\Form\Type\Ask\AskSoutenanceType;
use MentoratBundle\Form\Type\Add\SessionsType;
use MentoratBundle\Form\Type\Update\SuiviUpdateType;
use NotificationBundle\Services\Evenements;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class MentoratService
{
    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * @var FormFactory
     */
    private $form;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var TokenStorage
     */
    private $user;

    /**
     * @var AuthorizationChecker
     */
    private $security;

    /**
     * @var Evenements
     */
    private $events;

    /**
     * MentoratService constructor.
     *
     * @param EntityManager        $doctrine
     * @param FormFactory          $form
     * @param Session              $session
     * @param TokenStorage         $user
     * @param AuthorizationChecker $security
     * @param Evenements           $events
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, TokenStorage $user, AuthorizationChecker $security, Evenements $events)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->user = $user;
        $this->session = $session;
        $this->security = $security;
        $this->events = $events;
    }

    /**
     * Display the users with role : "ROLE_MENTOR".
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getMentors()
    {
        return $this->doctrine->getRepository('UserBundle:User')->getMentors();
    }

    /**
     * Display the users with role : "ROLE_MENTOR".
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getUserByRoleMentor($page, $maxResult)
    {
        return $this->doctrine->getRepository('UserBundle:User')->getUsersByRole($page, $maxResult);
    }

    /**
     * Count mentors with role : "ROLE_MENTOR".
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function countMentors()
    {
        return $this->doctrine->getRepository('UserBundle:User')->countMentorTotal();
    }

    /**
     * Display the mentores who are attributed to the connected user.
     *
     * @return array|\UserBundle\Entity\Mentore[]
     */
    public function getMentores($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Suivi')->findBy(array(
            'mentor' => $user,
            'suivi_state' => 'IN_PROGRESS',
        ));
    }

    /**
     * Return the number of student owned by the mentor in parameter.
     *
     * @param $mentor
     *
     * @return mixed
     */
    public function countMentoreByMentor($mentor)
    {
        return $this->doctrine->getRepository('MentoratBundle:Suivi')->countMentoreByMentorDisplayed($mentor);
    }

    /**
     * Display the mentore which are waiting to have the first
     * show and which are attributing to the connected user.
     *
     * @return array|\UserBundle\Entity\Mentore[]
     */
    public function getMyWaitingMentore($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Suivi')->findBy(array(
            'mentor' => $user,
            'suivi_state' => 'WAITING_LIST',
        ));
    }

    /**
     * Display the mentore which are waiting to have the first
     * show and which are attributing to the connected user.
     *
     * @return array|\UserBundle\Entity\Mentore[]
     */
    public function getMentoratFinished($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Suivi')->findBy(array(
            'mentor' => $user,
            'suivi_state' => 'ENDED',
        ));
    }

    /**
     * @param $user
     *
     * @return array|\MentoratBundle\Entity\Soutenance[]
     */
    public function getSoutenanceWaiting($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->findBy(array(
            'mentor' => $user,
            'status' => 'WAITING',
        ));
    }

    /**
     * @param $user
     *
     * @return array|\MentoratBundle\Entity\Soutenance[]
     */
    public function getSoutenanceDone($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->findBy(array(
            'mentor' => $user,
            'status' => 'DONE',
        ));
    }

    /**
     * Return the number of soutenances done by the mentor in parameter.
     *
     * @param $mentor
     *
     * @return mixed
     */
    public function countSoutenancesDone($mentor)
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->countSoutenancesDone($mentor);
    }

    /**
     * Allow to add a new note linked to the suivi and the mentor who follow the student.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addNote(Request $request, $id)
    {
        $suivi = $this->doctrine->getRepository('MentoratBundle:Suivi')
                                ->findOneBy(array(
                                    'id' => $id,
                                ));
        $note = new Notes();
        $user = $this->user->getToken()->getUser();

        $form = $this->form->create(NoteAddType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (false === $this->security->isGranted('ROLE_MENTOR')) {
                throw new AccessDeniedException('Vous ne disposez pas des droits d\'accès sur cette section.');
            }

            $note->setSuivi($suivi);
            $note->setAuteur($user);
            $note->setDateCreated(new \DateTime());
            $this->doctrine->persist($note);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'La note a bien été ajoutée.');

            $this->events->createUserEvents($user, 'Une note a bien été ajoutée.', 'information');
            $this->events->createMentoreEvents($suivi->getMentore(), 'Une note a bien été ajoutée.', 'information');
        }

        return $form;
    }

    /**
     * Allow to save a new session between a teacher and a student.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addSessionMentorat(Request $request, $id)
    {
        $mentore = $this->doctrine->getRepository('UserBundle:Mentore')->findOneBy(array('id' => $id));

        $mentor = $this->user->getToken()->getUser();

        $sessions = new Sessions();

        $form = $this->form->create(SessionsType::class, $sessions);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (false === $this->security->isGranted('ROLE_MENTOR')) {
                throw new AccessDeniedException('Vous ne disposez pas des droits d\'accès sur cette section.');
            }

            $sessions->setLibelle('Session de mentorat Premium Plus');
            $sessions->setMentor($mentor);
            $sessions->setMentore($mentore);
            $this->doctrine->persist($sessions);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'La session a bien été planifiée.');

            $this->events->createUserEvents($mentor, 'Une session a bien été planifiée.', 'information');
            $this->events->createMentoreEvents($mentore, 'Une session a bien été planifiée.', 'information');
        }

        return $form;
    }

    /**
     * Allow to change the status of a session.
     *
     * @param $id       | The id of the session.
     * @param $choice   | The choice used by the teacher.
     * @param $mentore  | The mentore linked to this session.
     */
    public function changeStatutSession($id, $choice, $mentore)
    {
        $session = $this->doctrine->getRepository('MentoratBundle:Sessions')->findOneBy(array('id' => $id));

        $mentore = $this->doctrine->getRepository('UserBundle:Mentore')->findOneBy(array('id' => $mentore));

        if (null === $session) {
            throw new Exception('La session ne semble pas exister.');
        } elseif ($mentore != $session->getMentore()) {
            throw new Exception('Le mentore ne semble pas être du coin, veuillez trouver charlie !');
        }

        switch ($choice) {
            case $choice === 'Validation':
                $session->setStatus('Present');
                break;
            case $choice === 'Annulation':
                $session->setStatus('Annulee');
                break;
            case $choice === 'Absent':
                $session->setStatus('Absent');
                break;
            case $choice === 'No Show':
                $session->setStatus('No Show');
                break;
            default:
                throw new Exception('Le statut doit être valide !');
        }

        $this->doctrine->flush();
        $this->session->getFlashBag()->add('success', 'Le statut de la session a bien été changé.');

        $this->events->createUserEvents($session->getMentor(), 'Le statut de la session a changé.', 'information');
        $this->events->createMentoreEvents($session->getMentore(), 'Le statut de la session a changé.', 'information');
    }

    /**
     * Allow to change the teacher who follow the student using the id | $id of the suivi.
     *
     * @param Request $request
     * @param $id               | The id of the suivi
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function transfertMentore(Request $request, $id)
    {
        $suivi = $this->doctrine->getRepository('MentoratBundle:Suivi')->findOneBy(array('id' => $id));

        if (null === $suivi) {
            throw new Exception('Le mentore ne semble pas exister ou avoir été archivé.');
        }

        $form = $this->form->create(SuiviUpdateType::class, $suivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (false === $this->security->isGranted('ROLE_MENTOR')) {
                throw new AccessDeniedException('Vous ne disposez pas des droits d\'accès sur cette section.');
            }

            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le changement de mentor a été effectué.');

            $this->events->createUserEvents($suivi->getMentor(), 'Le transfert de mentor a bien été effectué.', 'information');
            $this->events->createMentoreEvents($suivi->getMentore(), 'Le transfert de mentor a bien été effectué.', 'information');
        }

        return $form;
    }

    /**
     * Allow to add a soutenance between a teacher and a student, the teacher receive the notifications about the
     * creation in order to contact the student, the student receive the notification in order to be alerted.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addSoutenance(Request $request)
    {
        $soutenance = new Soutenance();

        $form = $this->form->create(SoutenanceAddType::class, $soutenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (false === $this->security->isGranted('ROLE_SUPERVISEUR_MENTOR')) {
                throw new AccessDeniedException();
            }

            $this->doctrine->persist($soutenance);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'La soutenance a bien été enregistrée.');

            $this->events->createUserEvents($soutenance->getMentor(), 'Une soutenance a bien été planifiée.', 'information');
            $this->events->createMentoreEvents($soutenance->getMentore(), 'Une soutenance a bien été planifiée.', 'information');
        }

        return $form;
    }

    /**
     * Allow a teacher to ask for a new soutenance linked to a student using is $id.
     *
     * @param Request $request
     * @param $id               | The id of the student
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function askSoutenance(Request $request, $id)
    {
        $mentore = $this->doctrine->getRepository('UserBundle:Mentore')->findOneBy(array('id' => $id));

        if (null === $mentore) {
            throw new Exception("L'élève semble ne pas exister.");
        }

        $soutenance = new Soutenance();

        $form = $this->form->create(AskSoutenanceType::class, $soutenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (false === $this->security->isGranted('ROLE_MENTOR')) {
                throw new AccessDeniedException('Vous ne disposez pas des droits d\'accès sur cette section.');
            }

            $soutenance->setMentore($mentore);
            $soutenance->setMentor($this->user->getToken()->getUser());
            $soutenance->setStatus('Demande');
            $soutenance->setDateDemande(new \DateTime());
            $this->doctrine->persist($soutenance);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'La demande de soutenance a bien été envoyée.');

            $this->events->createUserEvents($this->user->getToken()->getUser(), 'Une demande de soutenance a bien été envoyée.', 'information');
            $this->events->createMentoreEvents($mentore, 'Une demande de soutenance a bien été envoyée.', 'information');
        }

        return $form;
    }

    /**
     * Allow a teacher to become unavailable using is $id.
     *
     * @param $id   | The id of the teacher
     */
    public function mentorIndispo($id)
    {
        if (false === $this->security->isGranted('ROLE_MENTOR')) {
            throw new AccessDeniedException('Vous ne disposez pas des droits d\'accès sur cette section.');
        }

        $mentor = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));

        $mentor->setAvailable(false);

        $this->doctrine->flush();

        return $this->session->getFlashBag()->add('success', 'Votre status est bien passé à "Indisponible", à bientôt !');
    }

    /**
     * Allow a teacher to become available using is $id.
     *
     * @param $id   | The id of the teacher
     */
    public function mentorDispo($id)
    {
        if (false === $this->security->isGranted('ROLE_MENTOR')) {
            throw new AccessDeniedException('Vous ne disposez pas des droits d\'accès sur cette section.');
        }

        $mentor = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));

        $mentor->setAvailable(true);

        $this->doctrine->flush();

        return $this->session->getFlashBag()->add('success', 'On est heureux de vous revoir ! Bonnes séances de mentorat !');
    }

    /**
     * Allow to find a student using is $id.
     *
     * @param $id
     *
     * @return null|object|\UserBundle\Entity\Mentore
     */
    public function viewMentore($id)
    {
        if (false === $this->security->isGranted('ROLE_MENTOR') || $this->security->isGranted('ROLE_MENTORE')) {
            throw new AccessDeniedException('Vous ne disposez pas des droits d\'accès sur cette section.');
        }

        return $this->doctrine->getRepository('UserBundle:Mentore')->find($id);
    }

    /**
     * Allow to find a teacher by is $id in order to show details.
     *
     * @param $id
     *
     * @return null|object|\UserBundle\Entity\User
     */
    public function viewMentor($id)
    {
        if (false === $this->security->isGranted('ROLE_MENTOR') || $this->security->isGranted('ROLE_MENTORE')) {
            throw new AccessDeniedException('Vous ne disposez pas des droits d\'accès sur cette section.');
        }

        return $this->doctrine->getRepository('UserBundle:User')->find($id);
    }
}
