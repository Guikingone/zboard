<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class InfosController extends Controller
{
    /**
   * @Route("/infos/{page}", defaults={"page" = 1}, name="infos")
   * @Template("MentoratBundle/Dashboard/infos.html.twig")
   * @Method({"GET"})
   *
   * @param Request $request
   *
   * @return array
   */
  public function indexAction(Request $request, $page)
  {
      $information = $this->get('core.back')->addMentoratInformation($request);
      $informations = $this->get('core.back')->getMentoratInformations($page, 3);
      $nbInfos = $this->get('core.back')->countInfos();

      $pagination = array(
          'page' => $page,
          'route' => 'infos',
          'pages_count' => ceil($nbInfos / 3),
          'route_params' => array(),
      );

      return array(
          'controller' => 'infos',
          'informations' => $informations,
          'information' => $information->createView(),
          'pagination' => $pagination,
          'title_action' => 'Informations sur le mentorat',
      );
  }
}
