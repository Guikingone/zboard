<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DashboardController extends Controller
{
    /**
     * @Route("/")
     * @Template("MentoratBundle/Dashboard/index.html.twig")
     */
    public function indexAction()
    {
        return array(
            'controller'    => 'dashboard',
            'title_action'  => "Accueil"
        );
    }
}
