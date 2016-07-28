<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class indexAdminController extends Controller
{
    /**
     * @Route("/", name="home_admin")
     * @Template("AdminBundle/Index/index.html.twig")
     */
    public function indexAction()
    {
        $mentors = $this->get('core.user')->getMentors();
        $mentoresPlus = $this->get('core.statistiques')->getMentoresPlus();
        $mentoresPClass = $this->get('core.statistiques')->getMentoreClass();
        $parcoursPlus = $this->get('core.statistiques')->getParcoursPlus();
        $parcoursClass = $this->get('core.statistiques')->getParcoursClass();
        $projets = $this->get('core.statistiques')->getProjets();
        $projetsF = $this->get('core.statistiques')->getProjetsFinished();
        $soutenances = $this->get('core.statistiques')->getSoutenances();
        $mentorsW = $this->get('core.statistiques')->getMentoresWaiting();
        $notes = $this->get('core.statistiques')->getNotesSuivi();
        $sessionsC = $this->get('core.statistiques')->getSessionsCancelled();

        return array(
            'controller' => 'home',
            'mentors' => $mentors,
            'mentoresPlus' => $mentoresPlus,
            'mentoresPClass' => $mentoresPClass,
            'parcoursPlus' => $parcoursPlus,
            'parcoursClass' => $parcoursClass,
            'projetsF' => $projetsF,
            'projets' => $projets,
            'soutenances' => $soutenances,
            'mentoresW' => $mentorsW,
            'notes' => $notes,
            'sessionsC' => $sessionsC,
        );
    }
}
