<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends Controller
{
    /**
   * @param Request $request
   *
   * @return array
   *
   * @Route("/settings", name="settings")
   * @Template("BackBundle/Index/settings.html.twig")
   */
  public function showMentorsAction(Request $request)
  {
      return array(
          'controller' => 'settings',
      );
  }
}
