<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexBackController extends Controller
{
    /**
     * @Route("/", name="home_backend")
     * @Template("BackBundle/index/index.html.twig")
     */
    public function indexAction()
    {
        $mentors = $this->get('core.back')->getMentors();
        $mentores = $this->get('core.back')->getMentores();

        return array('mentors' => $mentors, 'mentores' => $mentores);
    }

    /**
     * @Route("/show/{id}/details", name="show_details_mentore")
     * @Template("BackBundle/Action/Details/show_mentores.html.twig")
     * @Method("GET")
     */
    public function detailsMentoreAction($id)
    {
        $mentores = $this->get('core.back')->viewMentore($id);

        return array('mentores' => $mentores);
    }
}
