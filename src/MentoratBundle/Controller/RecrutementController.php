<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RecrutementController extends Controller
{
    /**
     * @Route("/recrutement/candidatures",name="recrutement_candidature")
     * @Template("MentoratBundle/Recrutement/candidatures.html.twig")
     */
    public function candidatureAction()
    {
      $this->denyAccessUnlessGranted('ROLE_MENTOR_EXPERIMENTE', null, 'Accès refusé');

      $candidatures = $this->get('core.recrutement')->getCandidatures();

      return array('controller'=>'recrutement',
                   'candidatures'=>$candidatures['candidatures_simples']);
    }

    /**
     * @Route("/recrutement/candidatures/show/{id}",name="recrutement_candidature_show")
     * @Template("MentoratBundle/Recrutement/candidature.html.twig")
     */
    public function showCandidature()
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
