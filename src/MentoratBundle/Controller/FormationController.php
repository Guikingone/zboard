<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class FormationController extends Controller
{
    /**
     * @Route("/formation")
     * @Template("MentoratBundle/Dashboard/formation.html.twig")
     * @Method({"GET"})
     *
     * @return array
     */
    public function indexAction()
    {
        $formation = $this->get('core.formation')->getFormation();

        return array(
            'controller' => 'formation',
            'formation' => $formation,
            'title_action' => 'Formation',
        );
    }

    /**
     * @Route("/formation/update")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function updateAction(Request $request)
    {
        if ($request->request->get('id') !== null) {
            $this->get('core.formation')->updateFormation($request);
        }

        return new Response('OK', 200);
    }
}
