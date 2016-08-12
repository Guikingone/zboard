<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminBundle\Services;

use Doctrine\ORM\EntityManager;
use NotificationBundle\Services\Evenements;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use UserBundle\Form\Mentore\UpdateMentoreType;
use UserBundle\Form\User\UpdateUserType;

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
     * @var Evenements
     */
    private $events;

    /**
     * SecurityService constructor.
     *
     * @param EntityManager $doctrine
     * @param Session $session
     * @param FormFactory $form
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, Evenements $events)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->session = $session;
        $this->events = $events;
    }

    /**
     * Allow to active a teacher account.
     *
     * @param $id   | The id of the teacher
     */
    public function validateMentor($id)
    {
        $mentor = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));

        if (null === $mentor) {
            throw new Exception('L\'utilisateur semble ne pas exister.');
        }

        $mentor->setEnabled(true);

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le compte utilisateur a bien été activé.');
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
        }

        $form = $this->form->create(UpdateUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', "Le rôle de l'utilisateur a bien été mis à jour");
            $this->events->createUserEvents($user, 'Modifications de vos accès', 'Important');
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
        }

        $form = $this->form->create(UpdateMentoreType::class, $mentore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le rôle du mentoré a bien été mis à jour');
            $this->events->createUserEvents($mentore, 'Modifications de vos accès', 'Important');
        }

        return $form;
    }

}