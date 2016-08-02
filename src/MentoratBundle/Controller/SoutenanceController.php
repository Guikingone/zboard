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
     */
    public function waitingAction()
    {
        $soutenances = $this->get('core.soutenance')->getSoutenanceWaiting($this->getUser());

        return array(
            'controller' => 'soutenances',
            'soutenances' => $soutenances,
        );
    }

    /**
     * @Route("/effectuees",name="soutenance_done")
     * @Template("MentoratBundle/Soutenance/soutenance-terminee.html.twig")
     */
    public function soutenanceDoneAction()
    {
        $soutenances = $this->get('core.soutenance')->getSoutenanceDone($this->getUser());

        return array(
            'controller' => 'soutenances',
            'soutenances' => $soutenances,
        );
    }
}