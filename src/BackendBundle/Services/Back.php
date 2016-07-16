<?php

namespace BackendBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use BackendBundle\Entity\Financement;
use BackendBundle\Entity\Parcours;
use MentoratBundle\Entity\Mentore;
use BackendBundle\Entity\Country;
use BackendBundle\Entity\Projet;
use BackendBundle\Form\TypeAdd\ProjetTypeAdd;
use BackendBundle\Form\TypeAdd\FinancementTypeAdd;
use BackendBundle\Form\TypeAdd\ParcoursTypeAdd;
use BackendBundle\Form\TypeAdd\CountryTypeAdd;

use MentoratBundle\Form\MentoreType;
use UserBundle\Entity\User;
use UserBundle\Form\RegistrationType;

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
     * Allow the back to get all the mentors.
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getMentors()
    {
        return $this->doctrine->getRepository('UserBundle:User')->findAll();
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
     * Allow the back to get all the mentorat informations.
     *
     * @return array|\BackendBundle\Entity\InformationMentorat[]
     */
    public function getMentoratInformations()
    {
        return $this->doctrine->getRepository('BackendBundle:InformationMentorat')->findAll();
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
     * Allow to create a new instance of Mentor.
     *
     * @param Request $request
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addMentor(Request $request)
    {
        $mentor = new User();
        $form = $this->formFactory->create(RegistrationType::class, $mentor);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $mentor->setUsername($mentor->getFirstName() . '_' . $mentor->getLastName());
            $this->doctrine->persist($mentor);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', "Mentor enregistré.");
        }
        return $form;
    }

    /**
     *
     *
     * This section is devoted to the addAction, every add--- take the control for adding something in the Entity, in
     * order to be effective, the form of every entity is called here and instancied every time the controller ask for.
     *
     *
     */


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
     * Allow to add a new project.
     *
     * @param Request $request
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addProject(Request $request)
    {
        $projet = new Projet();
        $form = $this->formFactory->create(ProjetTypeAdd::class, $projet);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($projet);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Projet ajouté !');
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

    public function addCountry(Request $request)
    {
        $pays = new Country();
        $form = $this->formFactory->create(CountryTypeAdd::class, $pays);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($pays);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Pays ajouté !');
        }
        return $form;
    }
}
