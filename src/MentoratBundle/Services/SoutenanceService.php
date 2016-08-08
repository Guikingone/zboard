<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class SoutenanceService
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
     * @param $user
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
     * Return the number of soutenances done by the mentor in parameter
     * @param $mentor
     * @return mixed
     */
    public function countSoutenancesDone($mentor)
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->countSoutenancesDone($mentor);
    }
}
