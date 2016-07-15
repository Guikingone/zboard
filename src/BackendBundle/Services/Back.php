<?php

namespace BackendBundle\Services;

use BackendBundle\Entity\Financement;
use BackendBundle\Entity\Parcours;
use BackendBundle\Form\FinancementTypeAdd;
use BackendBundle\Form\ParcoursTypeAdd;
use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Mentore;
use MentoratBundle\Form\MentoreType;
use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

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
     * Allow the back to get all the mentores.
     *
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function getMentores()
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->findAll();
    }

    /**
     * Allow to find a student by is name in order to show details.
     *
     * @param $id
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function viewMentore($id)
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->find($id);
    }

    /**
     * Allow the back to get all the mentors.
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getMentors()
    {
        return $this->doctrine->getRepository('UserBundle:User')->findAll();
    }

    public function addMentor()
    {

    }

    /**
     * Allow to create a new instance of Mentore.
     *
     * @param Request $request
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addMentore(Request $request)
    {
        $mentore = new Mentore();
        $form = $this->formFactory->create(MentoreType::class, $mentore);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($mentore);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', "Elève enregistré.");
        }
        return $form;
    }

    /**
     * Allow to add a new path.
     *
     * @param Request $request
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addParcours(Request $request)
    {
        $parcours = new Parcours();
        $form = $this->formFactory->create(ParcoursTypeAdd::class, $parcours);
        $form->handleRequest($request);

        if ($form->isValid()) {
           $this->doctrine->persist($parcours);
           $this->doctrine->flush();
           $this->session->getFlashBag()->add('success', 'Parcours ajouté !');
        }
        return $form;
    }

    /**
     * Allow to add a new Financement.
     *
     * @param Request $request
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addFinancement(Request $request)
    {
        $financement = new Financement();
        $form = $this->formFactory->create(FinancementTypeAdd::class, $financement);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($financement);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Financeur ajouté !');
        }
        return $form;
    }
}