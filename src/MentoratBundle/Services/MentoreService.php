<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use MentoratBundle\Entity\Mentore;


class MentoreService {

    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * @param EntityManager $doctrine
     */
    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Display the mentore which are waiting to have the first
     * show and which are attributing to the connected user.
     *
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function getMyWaitingMentore()
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->findAll(
        );
    }

}