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

        return array('controller' => 'recrutement',
                  'title_action' => 'Recrutement de nouveaux mentors',
                   'candidatures' => $candidatures['candidatures_simples'],
                   'candidatures_dispute' => $candidatures['candidatures_a_arbitrer'], );
    }

    /**
     * @Route("/recrutement/candidatures/show/{id}",name="recrutement_candidature_show")
     * @Template("MentoratBundle/Recrutement/candidature.html.twig")
     */
    public function showCandidature($id)
    {
        $candidature = $this->get('core.recrutement')->getCandidature($id);

        $this->denyAccessUnlessGranted('ROLE_MENTOR_EXPERIMENTE', null, 'Accès refusé');

        return array('controller' => 'recrutement',
      'candidature' => $candidature,
      'title_action' => 'Candidature',
);
    }

    /**
     * @Route("/recrutement/candidatures/{id}/{action}",name="recrutement_candidature_action")
     * @Template("MentoratBundle/Recrutement/candidature.html.twig")
     */
    public function actOnApplication(Request $request,$id,$action)
    {
      // We first check the user is at least a mentor exp, and we'll later check if they're supervisors if they try to accept or refuse directly an application
      $this->denyAccessUnlessGranted('ROLE_MENTOR_EXPERIMENTE', null, 'Accès refusé');

      switch ($action)
      {
        case "accept":
          $this->denyAccessUnlessGranted('ROLE_SUPERVISEUR_MENTOR', null, 'Accès refusé');
          $this->get('core.recrutement')->acceptApplication($id,"");
          break;
        case "refuse":
          $this->denyAccessUnlessGranted('ROLE_SUPERVISEUR_MENTOR', null, 'Accès refusé');
          $this->get('core.recrutement')->rejectApplication($id,"");
          break;
        case "votefor":
          $this->get('core.recrutement')->voteApplication($id,true);
          break;
        case "voteagainst":
          $this->get('core.recrutement')->voteApplication($id,false);
          break;
      }

      return $this->redirectToRoute('recrutement_candidature');
    }



    /**
     * @Route("/recrutement/formations",name="recrutement_formation")
     * @Template("MentoratBundle/Recrutement/formation.html.twig")
     */
    public function formationAction()
    {
        $this->denyAccessUnlessGranted('ROLE_MENTOR_EXPERIMENTE', null, 'Accès refusé');

        $candidatures = $this->get('core.recrutement')->getFormationCandidatures();

        return array('controller' => 'recrutement',
                  'title_action' => 'Validation de formation des nouveaux mentors',
                   'candidatures' => $candidatures['candidatures_simples'],
                   'candidatures_dispute' => $candidatures['candidatures_a_arbitrer'], );
    }
}
