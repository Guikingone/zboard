<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Mentore;
use MentoratBundle\Entity\Notes;
use MentoratBundle\Entity\Sessions;
use MentoratBundle\Form\SessionsType;
use MentoratBundle\Form\TypeAdd\NoteTypeAdd;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MentoreService
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
     * Allow to get the sessions planified by the teacher into the teacher profil using is $id.
     *
     * @param $id
     *
     * @return array
     */
    public function getSessionsByMentor($id)
    {
        return $this->doctrine->getRepository('MentoratBundle:Sessions')->getSessionsbyMentor($id);
    }

    /**
     * Allow to get all the student followed by a teacher.
     *
     * @param $id
     *
     * @return array
     */
    public function getMentoresbyTeacher($id)
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->getStudentsByMentor($id);
    }

    /**
     * Display the mentores who are attributed to the connected user.
     *
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function getMentores($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Suivi')->findBy(array(
            'mentor' => $user,
            'state' => 'IN_PROGRESS',
        ));
    }

    /**
     * Display the mentore which are waiting to have the first
     * show and which are attributing to the connected user.
     *
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function getMyWaitingMentore($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Suivi')->findBy(array(
            'mentor' => $user,
            'state' => 'WAITING_LIST',
        ));
    }

    /**
     * Display the mentore which are waiting to have the first
     * show and which are attributing to the connected user.
     *
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function getMentoratFinished($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Suivi')->findBy(array(
            'mentor' => $user,
            'state' => 'MENTORAT_FINISHED',
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
        $mentore = $this->doctrine->getRepository('MentoratBundle:Mentore')->findOneBy(array('id' => $id));

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
     * Allow to find a student by is $id in order to show details.
     *
     * @param $id
     *
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function viewMentore($id)
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->find($id);
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
