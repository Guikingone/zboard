<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UtilsBackController extends Controller
{
    /**
     * @Route("/utils/{id}/mentors", name="update_mentors")
     * @Template("BackBundle/Action/Utils/update_mentors.html.twig")
     * @Method({"GET","POST"})
     * @param Request $request
     * @param $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateMentorsAction(Request $request, $id)
    {
        $mentor = $this->get('core.user')->updateMentors($request, $id);

        if ($mentor->isValid()) {
            return $this->redirectToRoute('show_details_mentor', array('id' => $id));
        }

        return array(
            'controller' => 'users',
            'mentor' => $mentor->createView(),
        );
    }

    /**
     * @Route("/utils/{id}/mentores", name="update_mentores")
     * @Template("BackBundle/Action/Utils/update_mentores.html.twig")
     * @Method({"GET","POST"})
     * @param Request $request
     * @param $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateMentoresAction(Request $request, $id)
    {
        $mentore = $this->get('core.user')->updateMentores($request, $id);

        if ($mentore->isValid()) {
            return $this->redirectToRoute('show_details_mentore', array('id' => $id));
        }

        return array(
            'controller' => 'mentore',
            'mentore' => $mentore->createView(),
        );
    }

    /**
     * @Route("/utils/{id}/path", name="update_parcours")
     * @Template("BackBundle/Action/Utils/update_parcours.html.twig")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateParcoursAction(Request $request, $id)
    {
        $parcours = $this->get('core.admin')->updateParcours($request, $id);

        if ($parcours->isValid()) {
            return $this->redirectToRoute('show_parcours', array('id' => $id));
        }

        return array(
            'controller' => 'parcours',
            'parcours' => $parcours->createView(),
        );
    }

    /**
     * @Route("/utils/{id}/courses", name="update_courses")
     * @Template("BackBundle/Action/Utils/update_courses.html.twig")
     * @Method({"GET","POST"})
     * @param Request $request
     * @param $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateCoursAction(Request $request, $id)
    {
        $cours = $this->get('core.admin')->updateCours($request, $id);

        if ($cours->isValid()) {
            return $this->redirectToRoute('show_parcours');
        }

        return array(
            'controller' => 'cours',
            'cours' => $cours->createView(),
        );
    }

    /**
     * @Route("/utils/{id}/project", name="update_project")
     * @Template("BackBundle/Action/Utils/update_projet.html.twig")
     * @Method({"GET","POST"})
     * @param Request $request
     * @param $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateProjetAction(Request $request, $id)
    {
        $projet = $this->get('core.admin')->updateProjet($request, $id);

        if ($projet->isValid()) {
            return $this->redirectToRoute('gestion_parcours');
        }

        return array(
            'controller' => 'projet',
            'projet' => $projet->createView(),
        );
    }

    /**
     * @Route("/utils/{id}/competence", name="update_competences")
     * @Template("BackBundle/Action/Utils/update_competences.html.twig")
     * @Method({"GET","POST"})
     * @param Request $request
     * @param $id
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateCompetencesAction(Request $request, $id)
    {
        $competence = $this->get('core.admin')->updateCompetencesProjet($request, $id);

        if ($competence->isValid()) {
            return $this->redirectToRoute('gestion_parcours');
        }

        return array(
            'controller' => 'competences',
            'competence' => $competence->createView(),
        );
    }

    /**
     * @Route("/utils/{id}/soutenance", name="update_soutenances")
     * @Template("BackBundle/Action/Utils/update_soutenances.html.twig")
     * @Method({"GET","POST"})
     * @param Request $request
     * @param $id
     *
     * @return array
     */
    public function updateSoutenancesAction(Request $request, $id)
    {
        $soutenance = $this->get('core.admin')->updateSoutenances($request, $id);

        if ($soutenance->isValid()) {
            return $this->redirectToRoute('gestion_soutenances');
        }

        return array(
            'controller' => 'soutenance',
            'soutenance' => $soutenance->createView(),
        );
    }

    /**
     * @Route("/archived/mentor/{id}", name="archive_mentor")
     * @Method({"GET","POST"})
     * @param $id
     *
     * @return array
     */
    public function archiveMentorAction($id)
    {
        $this->get('core.archive')->archiveMentor($id);

        return $this->redirectToRoute('home_backend');
    }

    /**
     * @Route("/archived/mentore/{id}", name="archive_mentore")
     * @Method({"GET", "POST"})
     *
     * @param $id
     *
     * @return array
     */
    public function archiveMentoreAction($id)
    {
        $this->get('core.archive')->archiveMentore($id);

        return $this->redirectToRoute('home_backend');
    }

    /**
     * @Route("/archived/path/{id}", name="archive_path")
     * @Method({"GET","PUT"})
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function archiveParcoursAction($id)
    {
        $this->get('core.archive')->archiveParcours($id);

        return $this->redirectToRoute('home_backend');
    }
}
