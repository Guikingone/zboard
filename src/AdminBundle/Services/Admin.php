<?php

namespace AdminBundle\Services;

use AdminBundle\Entity\Country;
use AdminBundle\Form\CountryType;
use BackendBundle\Entity\Abonnement;
use BackendBundle\Entity\Competences;
use BackendBundle\Entity\Cours;
use BackendBundle\Entity\Parcours;
use BackendBundle\Entity\Projet;
use BackendBundle\Form\_UpdateType\UpdateCompetencesType;
use BackendBundle\Form\_UpdateType\UpdateProjetType;
use BackendBundle\Form\CoursType;
use BackendBundle\Form\TypeAdd\CompetencesTypeAdd;
use BackendBundle\Form\TypeAdd\ProjetTypeAdd;
use BackendBundle\Form\UpdateAdd\ProjetUpdateType;
use BackendBundle\Form\TypeAdd\AbonnementTypeAdd;
use BackendBundle\Form\TypeAdd\ParcoursTypeAdd;
use BackendBundle\Form\UpdateAdd\CoursUpdateType;
use BackendBundle\Form\_UpdateType\UpdateCoursType;
use Doctrine\ORM\EntityManager;
use MentoratBundle\Entity\Mentore;
use MentoratBundle\Entity\Sessions;
use MentoratBundle\Entity\Suivi;
use MentoratBundle\Form\MentoreType;
use MentoratBundle\Form\TypeAdd\SoutenanceTypeAdd;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

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
     * Allow to get the courses linked to a path.
     *
     * @param $id
     *
     * @return array
     */
    public function getCours($id)
    {
        return $this->doctrine->getRepository('BackendBundle:Cours')->getCoursByParcours($id);
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
     * Allow to get all the sessions planified.
     *
     * @return array|\MentoratBundle\Entity\Sessions[]
     */
    public function getSessionsMentorat()
    {
        return $this->doctrine->getRepository('MentoratBundle:Sessions')->findAll();
    }

    /**
     * Allow to get the sessions planified by the teacher into the student profil using is $id.
     *
     * @param $id
     *
     * @return array
     */
    public function getSessionsByMentore($id)
    {
        return $this->doctrine->getRepository('MentoratBundle:Sessions')->getSessionsbyMentore($id);
    }

    /**
     * Allow to get all the country save in BDD.
     *
     * @return \AdminBundle\Entity\Country[]|array
     */
    public function getCountry()
    {
        return $this->doctrine->getRepository('AdminBundle:Country')->findAll();
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

        $form = $this->form->create(ParcoursTypeAdd::class, $parcours);
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

        $form = $this->form->create(ProjetTypeAdd::class, $projet);
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
        $competencesProject = new Competences();

        $form = $this->form->create(CompetencesTypeAdd::class, $competencesProject);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($competencesProject);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Competences ajouté !');
        }

        return $form;
    }

    /**
     * Allow to add a new courses linked to a path.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addCours(Request $request, $id)
    {
        $parcours = $this->doctrine->getRepository('BackendBundle:Parcours')->findOneBy(array('id' => $id));

        $cours = new Cours();

        $form = $this->form->create(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cours->setParcours($parcours);
            $this->doctrine->persist($cours);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le cours a bien été ajouté.');
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
     * Allow to add a new Country.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function addCountry(Request $request)
    {
        $country = new Country();

        $form = $this->form->create(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->persist($country);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le pays a bien été enregistré.');
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
     * Allow to update the path using is $id.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function updateParcours(Request $request, $id)
    {
        $parcours = $this->doctrine->getRepository('BackendBundle:Parcours')->findOneBy(array('id' => $id));

        if (null === $parcours) {
            throw new NotFoundHttpException('Le parcours ne semble pas exister.');
        }

        $form = $this->form->create(ParcoursTypeAdd::class, $parcours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le parcours a bien été mis à jour.');
        }

        return $form;
    }

    public function updateCours(Request $request, $id)
    {
        $cours = $this->doctrine->getRepository('BackendBundle:Cours')->findOneBy(array('id' => $id));

        if (null === $cours) {
            throw new NotFoundHttpException('Le cours ne semble pas exister.');
        }

        $form = $this->form->create(UpdateCoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le cours a bien été mise à jour.');
        }

        return $form;
    }

    /**
     * Allow to update a project using is $id.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function updateProjet(Request $request, $id)
    {
        $projet = $this->doctrine->getRepository('BackendBundle:Projet')->findOneBy(array('id' => $id));

        if (null === $projet) {
            throw new NotFoundHttpException('Le projet ne semble pas exister.');
        }

        $form = $this->form->create(UpdateProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le projet a bien été mis à jour.');
        }

        return $form;
    }

    public function updateCompetencesProjet(Request $request, $id)
    {
        $competences = $this->doctrine->getRepository('BackendBundle:Competences')->findOneBy(array('id' => $id));

        if (null === $competences) {
            throw new NotFoundHttpException('La competences ne semble pas exister');
        }

        $form = $this->form->create(UpdateCompetencesType::class, $competences);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'La compétence a bien été mise à jour');
        }

        return $form;
    }

    /**
     * Allow to update the soutenance using is $id.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function updateSoutenances(Request $request, $id)
    {
        $soutenances = $this->doctrine->getRepository('MentoratBundle:Soutenance')->findOneBy(array('id' => $id));

        if (null === $soutenances) {
            throw new NotFoundHttpException('Il semble que la soutenance n\'existe pas');
        }

        $form = $this->form->create(SoutenanceTypeAdd::class, $soutenances);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'La soutenance a bien été mise à jour.');
        }

        return $form;
    }

    /**
     * Allow to update the status of a courses.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function updateStatusCourses(Request $request, $id)
    {
        $cours = $this->doctrine->getRepository('BackendBundle:Cours')->findOneBy(array('id' => $id));

        $form = $this->form->create(CoursUpdateType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le cours a bien été mis à jour.');
        }

        return $form;
    }

    /**
     * Allow to update the status of a courses.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function updateStatusProject(Request $request, $id)
    {
        $projet = $this->doctrine->getRepository('BackendBundle:Projet')->findOneBy(array('id' => $id));

        $form = $this->form->create(ProjetUpdateType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le projet a bien été mis à jour.');
        }

        return $form;
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
