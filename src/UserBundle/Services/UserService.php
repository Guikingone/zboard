<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Services;

use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Suivi;
use NotificationBundle\Services\Evenements;
use AdminBundle\Services\Mail;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use UserBundle\Entity\Competences;
use UserBundle\Entity\Mentore;
use UserBundle\Entity\User;
use UserBundle\Form\CompetencesType;
use UserBundle\Form\Mentore\UpdateMentoreType;
use UserBundle\Form\RegistrationMentoreType;
use UserBundle\Form\RegistrationType;
use UserBundle\Form\User\UpdateUserType;

class UserService
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
     * @var TokenStorage
     */
    private $user;

    /**
     * @var Evenements
     */
    private $events;

    /**
     * @var Mail
     */
    private $mail;

    /**
     * Admin constructor.
     *
     * @param EntityManager $doctrine
     * @param FormFactory   $form
     * @param Session       $session
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, TokenStorage $user, Evenements $events, Mail $mail)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->session = $session;
        $this->user = $user;
        $this->events = $events;
        $this->mail = $mail;
    }

    /**
     * Allow the back to get all the mentors.
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getMentors()
    {
        return $this->doctrine->getRepository('UserBundle:User')->findBy(array('archived' => false));
    }

    /**
     * Allow the back to get all the mentores.
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getMentores()
    {
        return $this->doctrine->getRepository('UserBundle:Mentore')->findBy(array('archived' => false));
    }

    /**
     * Allow to get all the student who's on the waiting status.
     *
     * @return array
     */
    public function getMentoresWaiting()
    {
        return $this->doctrine->getRepository('UserBundle:Mentore')->getMentoresWaiting();
    }

    /**
     * Allow to get all the student who use the Premium Plus abonnement.
     *
     * @return array
     */
    public function getMentoresPPlus()
    {
        return $this->doctrine->getRepository('UserBundle:Mentore')->getMentoresPPlus();
    }

    /**
     * Allow to get all the student who use the Premium Class abonnement.
     *
     * @return array
     */
    public function getMentoresPClass()
    {
        return $this->doctrine->getRepository('UserBundle:Mentore')->getMentoresPClass();
    }

    /**
     * Allow to get all the competences linked to a teacher.
     *
     * @param $id
     *
     * @return array
     */
    public function getMentorCompetences($id)
    {
        return $this->doctrine->getRepository('UserBundle:Competences')->getCompetencesByMentor($id);
    }

    /**
     * Allow to create a new instance of Mentor, in order to be fast and effective, the registration of a new mentor
     * doesn't require that the back enter a Username or a Password, this tasks are handled by the system, after the
     * registration, an email is sent to the user in order to remember him the creation of his profile.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addMentor(Request $request)
    {
        $mentor = new User();
        $form = $this->form->create(RegistrationType::class, $mentor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mentor->setUsername($mentor->getFirstname().'_'.$mentor->getLastname());
            $mentor->setPlainPassword(mb_strtolower($mentor->getFirstname().'_'.$mentor->getLastname()));
            $mentor->setRoles(array('ROLE_MENTOR'));
            $mentor->setArchived(false);
            $mentor->setEnabled(true);
            $this->doctrine->persist($mentor);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Mentor enregistré.');
            $this->events->createUserEvents($mentor, "Création d'un nouveau mentor", 'Important');
            $this->mail->inscriptionMessage($mentor->getEmail());
        }

        return $form;
    }

    /**
     * Allow to create a student using the User entity.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addMentore(Request $request)
    {
        $mentore = new Mentore();
        $suivi = new Suivi();

        $mentore->setSuivi($suivi);
        $suivi->setMentore($mentore);
        $suivi->setLibelle('Suivi Premium Plus');

        $form = $this->form->create(RegistrationMentoreType::class, $mentore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mentore->setUsername($mentore->getFirstname().'_'.$mentore->getLastname());
            $mentore->setPlainPassword(mb_strtolower($mentore->getFirstname().'_'.$mentore->getLastname()));
            $mentore->setRoles(array('ROLE_MENTORE'));
            $mentore->setArchived(false);
            $mentore->setEnabled(true);
            $this->doctrine->persist($mentore);
            $this->doctrine->persist($suivi);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Elève enregistré.');
            $this->events->createUserEvents($mentore, 'Création de votre profil.', 'Important');
        }

        return $form;
    }

    /**
     * Allow to add a new set of competences to a teacher profil.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addCompetencesMentor(Request $request, $id)
    {
        $mentor = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));

        $competence = new Competences();

        $form = $this->form->create(CompetencesType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competence->setUser($mentor);
            $this->doctrine->persist($competence);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'La compétence a bien été ajoutée.');
        }

        return $form;
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
            throw new NotFoundHttpException("L'utilisateur ne semble pas exister.");
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
            throw new NotFoundHttpException('Le mentoré ne semble pas exister.');
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

    /**
     * Allow to update the informations about a teacher.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function updateMentors(Request $request, $id)
    {
        $mentor = $this->doctrine->getRepository('UserBundle:User')->find($id);

        if (null === $mentor) {
            throw new NotFoundHttpException('Le mentor ne semble pas exister');
        }

        $form = $this->form->create(RegistrationType::class, $mentor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le mentor a bien été mis à jour');
            $this->events->createUserEvents($mentor, 'Modifications de votre profil', 'Important');
        }

        return $form;
    }

    /**
     * Allow to update the informations about a student.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function updateMentores(Request $request, $id)
    {
        $mentore = $this->doctrine->getRepository('UserBundle:Mentore')->find($id);

        if (null === $mentore) {
            throw new NotFoundHttpException('Le mentore ne semble pas exister.');
        }

        $form = $this->form->create(RegistrationMentoreType::class, $mentore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le mentore a bien été mis à jour');
            $this->events->createUserEvents($mentore, 'Modifications de votre profil', 'Important');
        }

        return $form;
    }
}
