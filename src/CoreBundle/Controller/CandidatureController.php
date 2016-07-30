<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CandidatureController extends Controller
{
  /**
   * @Route("/join",name="join")
   */
  public function indexAction()
  {
      return $this->render('CoreBundle/Default/candidature.html.twig');
  }
}
