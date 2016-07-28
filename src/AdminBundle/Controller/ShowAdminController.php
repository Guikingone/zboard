<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShowAdminController extends Controller
{
    /**
     * @Route("/show/abonnements", name="gestion_abonnements")
     * @Template("AdminBundle/Action/list_abonnements.html.twig")
     *
     * @param Request $request
     */
    public function showAbonnementsAction(Request $request)
    {
        $abonnement = $this->get('core.admin')->addAbonnement($request);
        $abonnements = $this->get('core.admin')->getAbonnements();

        return array(
            'controller' => 'parcours',
            'abonnements' => $abonnements,
            'abonnement' => $abonnement->createView(),
        );
    }
}
