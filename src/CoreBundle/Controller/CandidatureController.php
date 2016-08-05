<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CandidatureController extends Controller
{
    /**
   * @Route("/join",name="join")
   * @Template("CoreBundle/Default/candidature.html.twig")
   */
  public function indexAction()
  {
      return array(
        'controller' => 'candidature',
    );
  }
}
