<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Notes;
use MentoratBundle\Entity\Sessions;
use MentoratBundle\Form\SessionsType;
use MentoratBundle\Form\TypeAdd\NoteTypeAdd;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MentorService
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
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, TokenStorage $user)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->session = $session;
        $this->user = $user;
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
}
