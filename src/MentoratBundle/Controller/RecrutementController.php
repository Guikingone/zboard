<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class RecrutementController extends Controller
{
    /**
     * @Route("/recrutement/candidatures",name="recrutement_candidature")
     * @Template("MentoratBundle/Recrutement/candidatures.html.twig")
     *
     * @return array
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
     *
     * @return array
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
    public function actOnApplication(Request $request, $id, $action)
    {
      // We first check the user is at least a mentor exp, and we'll later check if they're supervisors if they try to accept or refuse directly an application
      $this->denyAccessUnlessGranted('ROLE_MENTOR_EXPERIMENTE', null, 'Accès refusé');

      $this->get('core.recrutement')->action($action);

      return $this->redirectToRoute('recrutement_candidature');
    }

    /**
     * @Route("/recrutement/formations",name="recrutement_formation")
     * @Template("MentoratBundle/Recrutement/formation.html.twig")
     *
     * @return array
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
