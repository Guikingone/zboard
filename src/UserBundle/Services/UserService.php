<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 27/07/2016
 * Time: 15:42
 */

namespace UserBundle\Services;

use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Suivi;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use UserBundle\Entity\Competences;
use UserBundle\Entity\User;
use UserBundle\Form\CompetencesType;
use UserBundle\Form\RegistrationType;

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
     * Admin constructor.
     *
     * @param EntityManager $doctrine
     * @param FormFactory   $form
     * @param Session       $session
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, TokenStorage $user)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->session = $session;
        $this->user = $user;
    }

    /**
     * Allow the back to get all the mentors.
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getMentors()
    {
        return $this->doctrine->getRepository('UserBundle:User')
                              ->findBy(array('archived' => false,
                                             'roles' => array('ROLE_MENTOR')));
    }

    /**
     * Allow the back to get all the mentores.
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getMentores()
    {
        return $this->doctrine->getRepository('UserBundle:User')
                              ->findBy(array('archived' => false,
                                             'roles' => array('ROLE_MENTORE')));
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
     * doesn't require that the back enter a Username or a Password, this tasks are handled by the system.
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

        if ($form->isValid()) {
            $mentor->setUsername($mentor->getFirstName().'_'.$mentor->getLastName());
            $mentor->setPlainPassword(mb_strtolower($mentor->getFirstName().'_'.$mentor->getLastName()));
            $mentor->setRoles(array('ROLE_MENTOR'));
            $mentor->setArchived(false);
            $this->doctrine->persist($mentor);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Mentor enregistré.');
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
        $mentore = new User();
        $suivi = new Suivi();

        $form = $this->form->create(RegistrationType::class, $mentore);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $mentore->setUsername($mentore->getFirstName() . '_' . $mentore->getLastName());
            $mentore->setPlainPassword(mb_strtolower($mentore->getFirstName() . '_' . $mentore->getLastName()));
            $mentore->setRoles(array('ROLE_MENTORE'));
            $mentore->setArchived(false);
            $mentore->addSuivi($suivi);
            $this->doctrine->persist($mentore);
            $this->doctrine->persist($suivi);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Elève enregistré.');
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
        }

        return $form;
    }
}