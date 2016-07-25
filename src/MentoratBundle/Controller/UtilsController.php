<?php

namespace MentoratBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UtilsController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     *
     * @Route("/utils/{id}/courses/update", name="update_status_courses")
     * @Template("MentoratBundle/Action/Utils/update_status_courses.html.twig")
     */
    public function updateCoursAction(Request $request, $id)
    {
        $cours = $this->get('core.admin')->updateStatusCourses($request, $id);

        return array('cours' => $cours->createView());
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     *
     * @Route("/utils/{id}/project/update", name="update_status_project")
     * @Template("MentoratBundle/Action/Utils/update_status_project.html.twig")
     */
    public function updateProjectStatus(Request $request, $id)
    {
        $projet = $this->get('core.admin')->updateStatusProject($request, $id);

        return array('projet' => $projet->createView());
    }
}
