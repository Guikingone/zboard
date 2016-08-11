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
use MentoratBundle\Form\SessionsType;
use MentoratBundle\Form\TypeAdd\NoteTypeAdd;
use MentoratBundle\Form\Update\SuiviUpdateType;
use NotificationBundle\Services\Evenements;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

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
     * @var Evenements
     */
    private $events;

    /**
     * MentoratService constructor.
     *
     * @param EntityManager $doctrine
     * @param FormFactory   $form
     * @param Session       $session
     * @param Evenements    $events
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, TokenStorage $user, Evenements $events)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->events = $events;
        $this->user = $user;
        $this->session = $session;
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

        $form = $this->form->create(NoteTypeAdd::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note->setSuivi($suivi);
            $note->setAuteur($user);
            $note->setDateCreated(new \DateTime());
            $this->doctrine->persist($note);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'La note a bien été ajoutée.');
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
            $sessions->setLibelle('Session de mentorat Premium Plus');
            $sessions->setMentor($mentor);
            $sessions->setMentore($mentore);
            $this->doctrine->persist($sessions);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'La session a bien été planifiée.');
            $this->events->createUserEvents($mentore, 'Planification d\'une session', 'Important');
            $this->events->createUserEvents($mentor, 'Planification d\'une session', 'Important');
        }

        return $form;
    }

    /**
     * Allow to change the teacher who follow the student using the id | $id of the suivi.
     *
     * @param Request $request | The Request manager
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
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le changement de mentor a été effectué.');
            $this->events->createUserEvents($suivi->getMentor(), 'Changement de mentor effectué', 'Important');
            $this->events->createMentoreEvents(
                $suivi->getMentore(),
                'Changement de mentor effectué, votre nouveau mentor prendre contact avec vous rapidement',
                'Important'
            );
        }

        return $form;
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
        return $this->doctrine->getRepository('UserBundle:User')->find($id);
    }


    /**
     * Function used to put the Available status to false
     * @param $id
     */
    public function mentorIndispo($id)
    {
        $mentor = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));
        $mentor->setAvailable(false);
        $this->doctrine->persist($mentor);
        $this->doctrine->flush();
        return $this->session->getFlashBag()->add('success', 'Votre status est bien passé à "Indisponible", à bientôt !');
    }


    /**
     * Function used to put the Available status to true
     * @param $id
     */
    public function mentorDispo($id)
    {
        $mentor = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));
        $mentor->setAvailable(true);
        $this->doctrine->persist($mentor);
        $this->doctrine->flush();
        return $this->session->getFlashBag()->add('success', 'On est heureux de vous revoir ! Bonnes séances de mentorat !');
    }
}
