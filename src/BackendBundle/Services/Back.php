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
use EventListenerBundle\Event\GlobalNotificationEvent;
use EventListenerBundle\Event\ZboardEvents;
use NotificationBundle\Services\Evenements;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use BackendBundle\Entity\Tutoriel;
use MentoratBundle\Form\Type\Add\InformationType;
use MentoratBundle\Form\Type\Add\TutorielType;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;
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
     * @param EntityManager            $doctrine
     * @param FormFactory              $formFactory
     * @param Session                  $session
     * @param TokenStorage             $user
     * @param AuthorizationCheckerInterface $authorizationChecker
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
     * Allow the back to get all the mentorat informations.
     *
     * @return array|\BackendBundle\Entity\InformationMentorat[]
     */
    public function getMentoratInformations($page, $maxPerPage)
    {
        return $this->doctrine->getRepository('BackendBundle:InformationMentorat')->findBy(array('enabled' => true), array('id' => 'DESC'), $maxPerPage, $page - 1);
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
                throw new AccessDeniedException('Vous ne passerez pas !');
            }

            $information->setDCreated(new \DateTime('now'));
            $information->setUpdated(new \DateTime('now'));
            $information->setAuthor($this->user->getToken()->getUser());
            $this->doctrine->persist($information);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Information ajouté.');
            $this->events->createEvents('Nouvelle information ajoutée.', 'Information');
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
            if (false === $this->authorizationChecker->isGranted('ROLE_SUPERVISEUR_MENTOR')) {
                throw new AccessDeniedException('Vos droits ne vous permettent pas d\'accéder à cette section.');
            }

            $this->doctrine->persist($tutoriel);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Tutoriel ajouté.');
            $this->events->createEvents('Nouveau tutoriel ajouté.', 'Information');
        }

        return $form;
    }

    /**
     * Counts the number of visible informations.
     *
     * @return int
     */
    public function countInfos()
    {
        return count($this->doctrine->getRepository('BackendBundle:InformationMentorat')->findBy(array('enabled' => true)));
    }
}
