<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class IndexBackController extends Controller
{
    /**
     * @Route("/", name="home_backend")
     * @Template("BackBundle/index/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $mentors = $this->get('core.back')->getMentors();
        $mentores = $this->get('core.back')->getMentores();
        $nMentore = $this->get('core.back')->addMentore($request);
        return array( 'mentors' => $mentors, 'mentores' => $mentores, 'nMentore' => $nMentore->createView() );
    }

    /**
     * @Route("/list/mentore", name="list_backend")
     * @Template("BackBundle/Action/list.html.twig")
     * @Method("GET")
     */
    public function showMentoreAction()
    {
        $mentores = $this->get('core.back')->getMentores();
        return array( 'mentores' => $mentores );
    }
}
