<?php

namespace BackendBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Session\Session;

use UserBundle\Entity\User;

class Back {

    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Session
     */
    protected $session;

    /**
     * Back constructor.
     * @param EntityManager $doctrine
     * @param FormFactory $formFactory
     * @param Router $router
     * @param Session $session
     */
    public function __construct(EntityManager $doctrine, FormFactory $formFactory, Router $router, Session $session)
    {
        $this->doctrine = $doctrine;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->session = $session;
    }

    /**
     * Allow the back to get all the mentores in BDD and show the result in the back interface.
     *
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function getMentores()
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->findAll();
    }

    public function addMentor()
    {
    }
}