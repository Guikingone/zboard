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
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function getSoutenanceWaiting($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->findBy(array(
            'mentor' => $user,
            'status' => 'WAITING',
        ));
    }

    /**
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function getSoutenanceDone($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->findBy(array(
            'mentor' => $user,
            'status' => 'DONE',
        ));
    }
}
