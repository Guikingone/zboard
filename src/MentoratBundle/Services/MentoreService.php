<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Mentore;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MentoreService
{
    /**
     * @var EntityManager
     */
    protected $doctrine;

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
    public function __construct(EntityManager $doctrine, Session $session, TokenStorage $user)
    {
        $this->doctrine = $doctrine;
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
