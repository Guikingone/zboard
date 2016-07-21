<?php

namespace AdminBundle\Services;

use BackendBundle\Entity\Abonnement;
use BackendBundle\Form\TypeAdd\AbonnementTypeAdd;
use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Mentore;
use MentoratBundle\Entity\Suivi;
use MentoratBundle\Form\MentoreType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use UserBundle\Form\RegistrationType;

class Admin
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
     * Admin constructor.
     *
     * @param EntityManager $doctrine
     * @param FormFactory   $form
     * @param Session       $session
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
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
     * Allow to return the students learning a path in Premium Plusabonnements.
     *
     * @return array
     */
    public function getMentoresPlus()
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->getMentoresPlus();
    }

    /**
     * Allow to return the students learning a path in Premium Class abonnements.
     *
     * @return array
     */
    public function getMentoreClass()
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->getMentoresClass();
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
     * Allow to get the students waiting for a teacher.
     *
     * @return array
     */
    public function getMentoresWaiting()
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->getMentoresWaiting();
    }

    /**
     * Allow the back to get all the paths.
     *
     * @return array|\BackendBundle\Entity\Parcours[]
     */
    public function getParcours()
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->findAll();
    }

    /**
     * Allow to get all the abonnements.
     *
     * @return array|\BackendBundle\Entity\Abonnement[]
     */
    public function getAbonnements()
    {
        return $this->doctrine->getRepository('BackendBundle:Abonnement')->findAll();
    }

    /**
     * Allow the back to get all the paths made for the PPlus students.
     *
     * @return array|\BackendBundle\Entity\Parcours[]
     */
    public function getParcoursPlus()
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->getParcoursPlus();
    }

    /**
     * Allow the back to get all the paths made for the PClass students.
     *
     * @return array|\BackendBundle\Entity\Parcours[]
     */
    public function getParcoursClass()
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->getParcoursClass();
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
     * Allow to get all the projects.
     *
     * @return array|\BackendBundle\Entity\Projet[]
     */
    public function getProjets()
    {
        return $this->doctrine->getRepository('BackendBundle:Projet')->findAll();
    }

    /**
     * Allow the back to get all the soutenances.
     *
     * @return array|\MentoratBundle\Entity\Soutenance[]
     */
    public function getSoutenances()
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->findAll();
    }

    /**
     * Allow to get all the notes.
     *
     * @return array|\MentoratBundle\Entity\Notes[]
     */
    public function getNotesSuivi()
    {
        return $this->doctrine->getRepository('MentoratBundle:Notes')->findAll();
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
        $suivi = new Suivi();

        $mentore->setSuivi($suivi);
        $suivi->setMentore($mentore);

        $form = $this->form->create(MentoreType::class, $mentore);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($mentore);
            $this->doctrine->persist($suivi);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Elève enregistré.');
        }

        return $form;
    }

    /**
     * Allow to add a new abonnement.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addAbonnement(Request $request)
    {
        $abonnement = new Abonnement();
        $form = $this->form->create(AbonnementTypeAdd::class, $abonnement);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($abonnement);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', "L'abonnement a bien été ajouté !");
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
        $mentore = $this->doctrine->getRepository('MentoratBundle:Mentore')->find($id);

        if (null === $mentore) {
            throw new NotFoundHttpException('Le mentore ne semble pas exister.');
        }

        $form = $this->form->create(MentoreType::class, $mentore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le mentore a bien été mis à jour');
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
