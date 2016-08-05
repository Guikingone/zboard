<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RecrutementController extends Controller
{
    /**
     * @Route("/recrutement/candidatures",name="recrutement_candidature")
     * @Template("MentoratBundle/Recrutement/candidature.html.twig")
     */
    public function candidatureAction()
    {
      $this->denyAccessUnlessGranted('ROLE_MENTOR_EXPERIMENTE', null, 'Accès refusé');
      return array('controller'=>'recrutement');

    }

    /**
     * @Route("/recrutement/formations",name="recrutement_formation")
     * @Template("MentoratBundle/Recrutement/formation.html.twig")
     */
    public function formationAction()
    {
      $this->denyAccessUnlessGranted('ROLE_MENTOR_EXPERIMENTE', null, 'Accès refusé');

        return array('controller'=>'recrutement');
    }

}
