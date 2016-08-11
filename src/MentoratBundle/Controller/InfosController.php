<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class InfosController extends Controller
{
    /**
   * @Route("/infos")
   * @Template("MentoratBundle/Dashboard/infos.html.twig")
   *
   * @param Request $request
   *
   * @return array
   */
  public function indexAction(Request $request)
  {
      $information = $this->get('core.back')->addMentoratInformation($request);
      $informations = $this->get('core.back')->getMentoratInformations();

      return array(
          'controller' => 'infos',
          'informations' => $informations,
          'information' => $information->createView(),
          'title_action' => 'Informations sur le mentorat',
      );
  }
}
