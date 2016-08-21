<?php

namespace MentoratBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UtilsController extends Controller
{
    /**
     * @Route("/utils/{id}/courses/update", name="update_status_courses")
     * @Template("MentoratBundle/Action/Utils/update_status_courses.html.twig")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param $id
     *
     * @return array
     */
    public function updateCoursAction(Request $request, $id)
    {
        $cours = $this->get('core.admin')->updateStatusCourses($request, $id);

        if ($cours->isValid()) {
            return $this->redirectToRoute('mentorat_dashboard_index');
        }

        return array(
            'controller' => 'cours',
            'cours' => $cours->createView(),
            'title_action' => 'Mise à jour',
        );
    }

    /**
     * @Route("/utils/{id}/project/update", name="update_status_project")
     * @Template("MentoratBundle/Action/Utils/update_status_project.html.twig")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param $id
     *
     * @return array
     */
    public function updateProjectStatusAction(Request $request, $id)
    {
        $projet = $this->get('core.admin')->updateStatusProject($request, $id);

        if ($projet->isValid()) {
            return $this->redirectToRoute('mentorat_dashboard_index');
        }

        return array(
            'controller' => 'projet',
            'projet' => $projet->createView(),
            'title_action' => 'Mise à jour',
        );
    }

    /**
     * @Route("/sessions/update/{id}/{choice}", name="update_status_sessions")
     * @Method({"GET", "POST"})
     *
     * @param $id
     * @param $choice
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateSessionsStatusAction($id, $choice)
    {
        $this->get('core.mentorat')->changeStatutSession($id, $choice);

        return $this->redirectToRoute('mentorat_dashboard_index');
    }
}
