<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexBackController extends Controller
{
    /**
     * @Route("/", name="home_backend")
     * @Template("BackBundle/Index/index.html.twig")
     */
    public function indexAction()
    {
        $mentors = $this->get('core.user')->getMentors();
        $mentores = $this->get('core.admin')->getMentores();
        $soutenances = $this->get('core.back')->getSoutenances();
        $parcours = $this->get('core.back')->getParcours();
        $notes = $this->get('core.statistiques')->getNotesSuivi();
        $projets = $this->get('core.statistiques')->getProjetsFinished();
        $sessions = $this->get('core.statistiques')->getSessionsCancelled();
        $mentoresWaiting = $this->get('core.statistiques')->getMentoresWaiting();

        return array(
            'controller'        => 'home_back',
            'mentors'           => $mentors,
            'mentores'          => $mentores,
            'soutenances'       => $soutenances,
            'parcours'          => $parcours,
            'notes'             => $notes,
            'sessions'          => $sessions,
            'mentoresWaiting'   => $mentoresWaiting,
            'projets'           => $projets,
        );
    }
}
