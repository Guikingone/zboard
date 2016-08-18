<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class IndexBackController extends Controller
{
    /**
     * @Route("/", name="home_backend")
     * @Template("BackBundle/Index/index.html.twig")
     * @Method({"GET"})
     * @return array
     */
    public function indexAction()
    {
        $mentors = $this->get('core.user')->getMentors();
        $mentores = $this->get('core.user')->getMentores();
        $soutenances = $this->get('core.statistiques')->getSoutenancesWaiting();
        $parcours = $this->get('core.statistiques')->getParcours();
        $notes = $this->get('core.statistiques')->getNotesSuivi();
        $projets = $this->get('core.statistiques')->getProjetsFinished();
        $sessions = $this->get('core.statistiques')->getSessionsCancelled();
        $mentoresWaiting = $this->get('core.user')->getMentoresWaiting();

        return array(
            'controller'        => 'home_back',
            'mentors'           => $mentors,
            'mentores'          => $mentores,
            'soutenances'       => $soutenances,
            'parcours'          => $parcours,
            'notes'             => $notes,
            'sessions'          => $sessions,
            'projets'           => $projets,
            'mentoresWaiting'   => $mentoresWaiting,
        );
    }
}
