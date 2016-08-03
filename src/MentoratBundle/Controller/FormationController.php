<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class FormationController extends Controller
{
  /**
 * @Route("/formation")
 * @Template("MentoratBundle/Dashboard/formation.html.twig")
 */
public function indexAction(Request $request)
{
    $formation = $this->get('core.formation')->getFormation();

    return array(
        'controller' => 'formation',
        'formation' => $formation,
    );
}
}
