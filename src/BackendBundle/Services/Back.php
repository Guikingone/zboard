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
use BackendBundle\Entity\Financement;
use BackendBundle\Entity\Parcours;
use MentoratBundle\Entity\Mentore;
use BackendBundle\Entity\Projet;
use BackendBundle\Form\TypeAdd\ProjetTypeAdd;
use BackendBundle\Form\TypeAdd\FinancementTypeAdd;
use BackendBundle\Form\TypeAdd\ParcoursTypeAdd;
use MentoratBundle\Form\MentoreType;
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
     * Allow to get all the mentors.
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getMentors()
    {
        return $this->doctrine->getRepository('UserBundle:User')->findAll();
    }

    /**
     * Allow to get all the mentores.
     *
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function getMentores()
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->findAll();
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
     * Allow to add a new project.
     *
     * @param Request $request
     *
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
     * Allow to add a new Financement.
     *
     * @param Request $request
     *
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

    /**
     * Allow to find a student by is name in order to show details.
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
     * Allow to find a path by is id | $id.
     *
     * @param $id
     *
     * @return array|\BackendBundle\Entity\Parcours[]
     */
    public function viewParcours($id)
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->find($id);
    }
}
