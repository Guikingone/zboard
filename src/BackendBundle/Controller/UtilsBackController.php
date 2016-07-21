<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UtilsBackController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     * @Route("/utils/{id}/mentores", name="update_mentores")
     * @Template("BackBundle/Action/Utils/update_mentores.html.twig")
     */
    public function updateMentoresAction(Request $request, $id)
    {
        $mentore = $this->get('core.admin')->updateMentores($request, $id);

        return array('mentore' => $mentore->createView());
    }

    /**
     * @Route("/utils/{id}/mentors", name="update_mentors")
     */
    public function updateMentorsAction($id)
    {
    }
}
