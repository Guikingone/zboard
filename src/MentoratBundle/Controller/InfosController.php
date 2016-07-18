<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class InfosController extends Controller
{
    /**
   * @Route("/infos")
   * @Template("MentoratBundle/Dashboard/infos.html.twig")
   */
  public function indexAction()
  {
      $informations = $this->get('core.back')->getMentoratInformations();

      return array(
          'controller' => 'infos',
          'informations' => $informations,
      );
  }
}
