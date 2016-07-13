<?php

namespace BackendBundle\Controller;

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
        $mentores = $this->get('core.back')->getMentores();
        return array( 'mentores' => $mentores );
    }
}
