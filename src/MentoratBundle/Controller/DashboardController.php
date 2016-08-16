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
     *
     * @return array
     */
    public function indexAction()
    {
        $lastInformation = $this->get('core.back')->getMentoratInformations(1, 1);
        $mentores = $this->get('core.user')->getMentores();

        return array(
            'controller' => 'dashboard',
            'last_information' => $lastInformation,
            'title_action' => 'Accueil',
            'mentores' => $mentores,
        );
    }
}
