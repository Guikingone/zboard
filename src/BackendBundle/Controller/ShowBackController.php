<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShowBackController extends Controller
{
    /**
     * @param $id
     * @return array
     * @Route("/show/path/{id}/details", name="show_parcours")
     * @Template("BackBundle/Action/Details/show_parcours.html.twig")
     */
    public function showParcours(Request $request, $id)
    {
        $parcours = $this->get('core.back')->viewParcours($id);
        $projet   = $this->get('core.back')->addProject($request);
        return array( 'parcours' => $parcours, 'projet' => $projet->createView() );
    }
}
