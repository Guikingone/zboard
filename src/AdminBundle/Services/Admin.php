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

use AdminBundle\Entity\Country;
use AdminBundle\Form\Type\CountryType;
use BackendBundle\Entity\Abonnement;
use BackendBundle\Entity\Competences;
use BackendBundle\Entity\Cours;
use BackendBundle\Entity\Parcours;
use BackendBundle\Entity\Projet;
use BackendBundle\Form\Type\Add\CoursAddType;
use BackendBundle\Form\Type\Update\UpdateCompetencesType;
use BackendBundle\Form\Type\Update\UpdateProjetType;
use BackendBundle\Form\add\CompetencesAddType;
use BackendBundle\Form\add\ProjetAddType;
use BackendBundle\Form\UpdateAdd\ProjetUpdateType;
use BackendBundle\Form\add\AbonnementAddType;
use BackendBundle\Form\add\ParcoursAddType;
use BackendBundle\Form\UpdateAdd\CoursUpdateType;
use BackendBundle\Form\Type\Update\UpdateCoursType;
use Doctrine\ORM\EntityManager;
use MentoratBundle\Form\Add\SoutenanceAddType;
use NotificationBundle\Services\Evenements;
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
     * @var Evenements
     */
    private $events;

    /**
     * Admin constructor.
     *
     * @param EntityManager $doctrine
     * @param FormFactory   $form
     * @param Session       $session
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, TokenStorage $user, Evenements $events)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->session = $session;
        $this->user = $user;
        $this->events = $events;
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

        $form = $this->form->create(ParcoursAddType::class, $parcours);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $parcours->setArchived(false);
            $this->doctrine->persist($parcours);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Parcours ajouté !');
            $this->events->createEvents("Création d'un nouveau parcours", 'Important');
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

        $form = $this->form->create(ProjetAddType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projet->setParcours($parcours);
            $this->doctrine->persist($projet);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Projet ajouté !');
            $this->events->createEvents("Création d'un nouveau projet lié au parcours ".$parcours->getLibelle(), 'Information');
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

        $form = $this->form->create(CompetencesAddType::class, $competencesProject);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->doctrine->persist($competencesProject);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Competences ajouté !');
            $this->events->createEvents("Création d'une compétences à valider.", 'Important');
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

        $form = $this->form->create(CoursAddType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cours->setParcours($parcours);
            $this->doctrine->persist($cours);
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le cours a bien été ajouté.');
            $this->events->createEvents("Ajout d'un nouveau cours sur le parcours ".$parcours->getLibelle(), 'Information');
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
        $form = $this->form->create(AbonnementAddType::class, $abonnement);
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

        $form = $this->form->create(ParcoursAddType::class, $parcours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->flush();
            $this->session->getFlashBag()->add('success', 'Le parcours a bien été mis à jour.');
            $this->events->createEvents('Le parcours'.$parcours->getLibelle().' a été modifié.', 'Important');
        }

        return $form;
    }

    /**
     * Allow to update a courses linked to a path.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
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
            $this->events->createEvents('Le cours'.$cours->getLibelle().' a été modifié.', 'Important');
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
            $this->events->createEvents('Le projet'.$projet->getLibelle().' a été modifié.', 'Important');
        }

        return $form;
    }

    /**
     * Allow to update the competences linked to a project.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Symfony\Component\Form\FormInterface
     */
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
            $this->events->createEvents('Une compétence à valider a été mise à jour.', 'Important');
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

        $form = $this->form->create(SoutenanceAddType::class, $soutenances);
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
