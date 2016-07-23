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
        $mentors = $this->get('core.admin')->getMentors();
        $mentoresPPlus = $this->get('core.admin')->getMentoresPlus();
        $mentoresPClass = $this->get('core.admin')->getMentoreClass();
        $parcoursPlus = $this->get('core.admin')->getParcoursPlus();
        $parcoursClass = $this->get('core.admin')->getParcoursClass();
        $projets = $this->get('core.admin')->getProjets();
        $soutenances = $this->get('core.admin')->getSoutenances();
        $mentorsW = $this->get('core.admin')->getMentoresWaiting();
        $notes = $this->get('core.admin')->getNotesSuivi();
        $sessionsC = $this->get('core.admin')->getSessionsCancelled();

        return array('mentors' => $mentors, 'mentoresPPlus' => $mentoresPPlus,
                     'mentoresPClass' => $mentoresPClass, 'parcoursPlus' => $parcoursPlus,
                     'parcoursClass' => $parcoursClass, 'projets' => $projets, 'soutenances' => $soutenances,
                     'mentoresW' => $mentorsW, 'notes' => $notes, 'sessionsC' => $sessionsC, );
    }
}
