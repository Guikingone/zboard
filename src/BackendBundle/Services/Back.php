<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 * (c) Nathanaël Langlois <nathanael.langlois@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BackendBundle\Services;

use BackendBundle\Entity\InformationMentorat;
use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Soutenance;
use MentoratBundle\Form\TypeAdd\SoutenanceTypeAdd;
use NotificationBundle\Services\Evenements;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BackendBundle\Entity\Parcours;
use BackendBundle\Entity\Projet;
use BackendBundle\Entity\Tutoriel;
use MentoratBundle\Form\InformationType;
use MentoratBundle\Form\TutorielType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
     * @var AuthorizationCheckerInterface
     */
    protected $authorizationChecker;

    /**
     * @var Evenements
     */
    private $events;

    /**
     * Back constructor.
     *
     * @param EntityManager $doctrine
     * @param FormFactory   $formFactory
     * @param Session       $session
     */
    public function __construct(EntityManager $doctrine, FormFactory $formFactory, Session $session, TokenStorage $user, AuthorizationCheckerInterface $authorizationChecker, Evenements $events)
    {
        $this->doctrine = $doctrine;
        $this->formFactory = $formFactory;
        $this->session = $session;
        $this->user = $user;
        $this->authorizationChecker = $authorizationChecker;
        $this->events = $events;
    }

    /**
     * Allow to get all the paths.
     *
     * @return array|\BackendBundle\Entity\Parcours[]
     */
    public function getParcours()
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->getParcours();
    }

    /**
     * Allow to get all the paths who's been archived.
     *
     * @return array
     */
    public function getParcoursArchived()
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->getParcoursArchived();
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
     * Allow the back to get all the tutorials.
     *
     * @return array|\BackendBundle\Entity\InformationMentorat[]
     */
    public function getTutorials()
    {
        return $this->doctrine->getRepository('BackendBundle:Tutoriel')->findAll();
    }

    /**
     * Allow to add a soutenance between a teacher and a student, the teacher receive the notifications about the
     * creation in order to contact the student, the student receive the notification in order to be alert.
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

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $mentor = $data->getMentor();
            $mentore = $data->getMentore();

            $this->doctrine->persist($soutenance);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'La soutenance a bien été enregistrée.');
            $this->events->createUserEvents($mentor, 'Une soutenance a été planifiée.', 'Information');
            $this->events->createUserEvents($mentore, 'Une soutenance a été planifiée.', 'Information');
        }

        return $form;
    }

    /**
     * Creates a new MentoratInformation.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addMentoratInformation(Request $request)
    {
        $information = new InformationMentorat();

        $form = $this->formFactory->create(InformationType::class, $information);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if (false === $this->authorizationChecker->isGranted('ROLE_SUPERVISEUR_MENTOR')) {
                throw new AccessDeniedException();
            }
            $information->setDCreated(new \DateTime('now'));
            $information->setUpdated(new \DateTime('now'));
            $information->setAuthor($this->user->getToken()->getUser());
            $this->doctrine->persist($information);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Information ajouté.');
            $this->events->createEvents("Création d'une nouvelle information", 'Information');
        }

        return $form;
    }

    /**
     * Creates a new tutorial.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addTutorial(Request $request)
    {
        $tutoriel = new Tutoriel();

        $form = $this->formFactory->create(TutorielType::class, $tutoriel);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($tutoriel);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Tutoriel ajouté.');
            $this->events->createEvents("Création d'un nouveau tutoriel", 'Important');
        }

        return $form;
    }
}
