<?php

namespace BackendBundle\Services;

use BackendBundle\Entity\Competences;
use BackendBundle\Form\TypeAdd\CompetencesTypeAdd;
use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Soutenance;
use MentoratBundle\Form\TypeAdd\SoutenanceTypeAdd;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BackendBundle\Entity\Parcours;
use MentoratBundle\Entity\Mentore;
use BackendBundle\Entity\Projet;
use BackendBundle\Form\TypeAdd\ProjetTypeAdd;
use BackendBundle\Form\TypeAdd\ParcoursTypeAdd;
use MentoratBundle\Form\MentoreType;
use MentoratBundle\Form\InformationType;
use UserBundle\Entity\User;
use UserBundle\Form\RegistrationType;

class Back
{
    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var Session
     */
    protected $session;

    /**
     * Back constructor.
     *
     * @param EntityManager $doctrine
     * @param FormFactory   $formFactory
     * @param Session       $session
     */
    public function __construct(EntityManager $doctrine, FormFactory $formFactory, Session $session)
    {
        $this->doctrine = $doctrine;
        $this->formFactory = $formFactory;
        $this->session = $session;
    }

    /**
     * Allow the back to get all the new mentores since actual datetime.
     *
     * @return array
     */
    public function getNewMentores()
    {
        $days = new \DateTime();

        return $this->doctrine->getRepository('MentoratBundle:Mentore')->getNewMentores($days);
    }

    /**
     * Allow to get all the paths.
     *
     * @return array|\BackendBundle\Entity\Parcours[]
     */
    public function getParcours()
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->findAll();
    }

    /**
     * Allow th back to get access to the project linked to a path.
     *
     * @param $id
     *
     * @return array
     */
    public function getProjet($id)
    {
        return $this->doctrine->getRepository('BackendBundle:Projet')->getProjetByParcours($id);
    }

    /**
     * Allow to get all the soutenances.
     *
     * @return array|\MentoratBundle\Entity\Soutenance[]
     */
    public function getSoutenances()
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->findAll();
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
     * Creates a new MentoratInformation.
     *
     *@param Request $request
     *
     *@return \Symfony\Component\Form\FormInterface
     */
    public function addMentoratInformation(Request $request)
    {
        $information = new InformationMentorat();

        $form = $this->formFactory->create(InformationType::class, $information);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($information);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Information ajouté.');
        }

        return $form;
    }

    /**
     * Allow to create a new instance of Mentore.
     *
     * @param Request $request
     *
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
            $this->session->getFlashBag()->add('success', 'Elève enregistré.');
        }

        return $form;
    }

    /**
     * Allow to create a new instance of Mentor, in order to be fast and effective, the registration of a new mentor
     * doesn't require that the back enter a Username or a Password, this tasks are handled by the system.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addMentor(Request $request)
    {
        $mentor = new User();
        $form = $this->formFactory->create(RegistrationType::class, $mentor);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $mentor->setUsername($mentor->getFirstName().'_'.$mentor->getLastName());
            $mentor->setPlainPassword(strtolower($mentor->getFirstName().'_'.$mentor->getLastName()));
            $mentor->setRoles(array('ROLE_MENTOR'));
            $this->doctrine->persist($mentor);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Mentor enregistré.');
        }

        return $form;
    }

    /**
     * Allow to add a new path.
     *
     * @param Request $request
     *
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
     * Allow to add a new project linked to a path.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addProject(Request $request, $id)
    {
        $parcours = $this->doctrine->getRepository('BackendBundle:Parcours')->findOneBy(array('id' => $id));
        $projet = new Projet();

        $form = $this->formFactory->create(ProjetTypeAdd::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projet->setParcours($parcours);
            $this->doctrine->persist($projet);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Projet ajouté !');
        }

        return $form;
    }

    /**
     * Allow to add a new competences.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addCompetences(Request $request)
    {
        $competences = new Competences();

        $form = $this->formFactory->create(CompetencesTypeAdd::class, $competences);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($competences);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Competences ajouté !');
        }

        return $form;
    }

    /**
     * Allow to add a new soutenance between a mentor and a mentore.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addSoutenance(Request $request)
    {
        $soutenance = new Soutenance();
        $form = $this->formFactory->create(SoutenanceTypeAdd::class, $soutenance);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($soutenance);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Soutenance ajoutée !');
        }

        return $form;
    }
}
