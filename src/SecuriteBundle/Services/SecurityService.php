<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SecuriteBundle\Services;

use Doctrine\ORM\EntityManager;
use EventListenerBundle\Event\StudentNotificationEvent;
use EventListenerBundle\Event\UserNotificationEvent;
use EventListenerBundle\Event\ZboardEvents;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use UserBundle\Form\Type\Mentore\UpdateRolesMentoreType;
use UserBundle\Form\Type\User\UpdateRolesUserType;

class SecurityService
{
    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * @var FormFactory
     */
    private $form;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var AuthorizationChecker
     */
    private $security;

    /**
     * @var TraceableEventDispatcher
     */
    private $evet;

    /**
     * SecurityService constructor.
     *
     * @param EntityManager            $doctrine
     * @param Session                  $session
     * @param FormFactory              $form
     * @param AuthorizationChecker     $security
     * @param TraceableEventDispatcher $evet
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, AuthorizationChecker $security, TraceableEventDispatcher $evet)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->session = $session;
        $this->security = $security;
        $this->evet = $evet;
    }

    /**
     * Allow to activate a teacher account.
     *
     * @param $id   | The id of the teacher
     */
    public function validateMentor($id)
    {
        $mentor = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));

        if (null === $mentor) {
            throw new Exception('L\'utilisateur semble ne pas exister.');
        } elseif (false === $this->security->isGranted('ROLE_SUPERVISEUR_MENTOR')) {
            throw new AccessDeniedException('Vous ne passerez pas !');
        }

        $mentor->setEnabled(true);

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le compte utilisateur a bien été activé.');

        $event = new UserNotificationEvent($mentor, 'Activation de votre compte Zboard', 'Information');
        $this->evet->dispatch(ZboardEvents::USER_NOTIFICATION, $event);
    }

    /**
     * Allow to activate a student account.
     *
     * @param $id   | The id of the student
     */
    public function validateStudent($id)
    {
        $student = $this->doctrine->getRepository('UserBundle:Mentore')->findOneBy(array('id' => $id));

        if (null === $student) {
            throw new Exception('L\'élève ne semble pas exister');
        } elseif (false === $this->security->isGranted('ROLE_SUPERVISEUR_MENTOR')) {
            throw new AccessDeniedException('Vous ne passerez pas !');
        }

        $student->setEnabled(true);

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le compte élève a bien été activé.');

        $event = new StudentNotificationEvent($student, 'Activation de votre compte', 'Information');
        $this->evet->dispatch(ZboardEvents::STUDENT_NOTIFICATION, $event);
    }

    /**
     * Allow to update the roles of a user using is $id.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addRoleToUser(Request $request, $id)
    {
        $user = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));

        if (null === $user) {
            throw new Exception("L'utilisateur ne semble pas exister.");
        } elseif (false === $this->security->isGranted('ROLE_SUPERVISEUR_MENTOR')) {
            throw new AccessDeniedException('Vous ne passerez pas !');
        }

        $form = $this->form->create(UpdateRolesUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', "Le rôle de l'utilisateur a bien été mis à jour");

            $event = new UserNotificationEvent($user, 'Vos accès ont été modifiés.', 'Important');
            $this->evet->dispatch(ZboardEvents::USER_NOTIFICATION, $event);
        }

        return $form;
    }

    /**
     * Allow to update the roles of a student using is $id.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addRoleToMentore(Request $request, $id)
    {
        $mentore = $this->doctrine->getRepository('UserBundle:Mentore')->findOneBy(array('id' => $id));

        if (null === $mentore) {
            throw new Exception('Le mentoré ne semble pas exister.');
        } elseif (false === $this->security->isGranted('ROLE_SUPERVISEUR_MENTOR')) {
            throw new AccessDeniedException();
        }

        $form = $this->form->create(UpdateRolesMentoreType::class, $mentore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le rôle du mentoré a bien été mis à jour');

            $event = new StudentNotificationEvent($mentore, 'Vos accès ont été modifiés.', 'Important');
            $this->evet->dispatch(ZboardEvents::STUDENT_NOTIFICATION, $event);
        }

        return $form;
    }
}
