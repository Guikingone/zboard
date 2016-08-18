<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/mes-soutenances")
 */
class SoutenanceController extends Controller
{
    /**
     * @Route("/en-attente",name="soutenance_waiting")
     * @Template("MentoratBundle/Soutenance/en-attente.html.twig")
     *
     * @return array
     */
    public function waitingAction()
    {
        $soutenances = $this->get('core.mentorat')->getSoutenanceWaiting($this->getUser());

        return array(
            'controller' => 'soutenances',
            'soutenances' => $soutenances,
            'title_action' => 'Mes soutenances en attentes',
        );
    }

    /**
     * @Route("/effectuees",name="soutenance_done")
     * @Template("MentoratBundle/Soutenance/soutenance-terminee.html.twig")
     *
     * @return array
     */
    public function soutenanceDoneAction()
    {
        $soutenances = $this->get('core.mentorat')->getSoutenanceDone($this->getUser());

        return array(
            'controller' => 'soutenances',
            'soutenances' => $soutenances,
            'title_action' => 'Mes soutenances terminées',
        );
    }
}
