<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TutorielsController extends Controller
{
    /**
   * @Route("/tutoriels")
   * @Template("MentoratBundle/Dashboard/tutoriels.html.twig")
   * @Method({"GET","POST"})
   * @return array
   */
  public function indexAction(Request $request)
  {
      $tutoriel = $this->get('core.back')->addTutorial($request);
      $tutoriels = $this->get('core.back')->getTutorials();

      return array(
          'controller'      => 'tutoriels',
          'tutoriels'       => $tutoriels,
          'tutoriel'        => $tutoriel->createView(),
          'title_action'    => 'Tutoriels sur le mentorat',
      );
  }
}
