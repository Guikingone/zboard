<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RecrutementController extends Controller
{
    /**
     * @Route("/recrutement/candidatures",name="recrutement_candidature")
     * @Template("MentoratBundle/Recrutement/candidatures.html.twig")
     * @Method({"GET"})
     *
     * @return array
     */
    public function candidatureAction()
    {
        $this->denyAccessUnlessGranted('ROLE_MENTOR_EXPERIMENTE', null, 'Accès refusé');

        $candidatures = $this->get('core.recrutement')->getCandidatures();

        if (empty($candidatures)) {
            $candidatures['candidatures_simples'] = array();
            $candidatures['candidatures_a_arbitrer'] = array();
        }

        return array(
            'controller' => 'recrutement',
            'title_action' => 'Recrutement de nouveaux mentors',
            'candidatures' => $candidatures['candidatures_simples'],
            'candidatures_dispute' => $candidatures['candidatures_a_arbitrer'],
        );
    }

    /**
     * @Route("/recrutement/candidatures/show/{id}",name="recrutement_candidature_show")
     * @Template("MentoratBundle/Recrutement/candidature.html.twig")
     * @Method({"GET","POST"})
     *
     * @return array
     */
    public function showCandidatureAction(Request $request, $id)
    {
        $vote = $this->get('core.recrutement')->addVote($request, $id);
        if ($vote === null) {
            return $this->redirectToRoute('recrutement_candidature');
        }

        $candidature = $this->get('core.recrutement')->getCandidature($id);
        if ($candidature === null) {
            return $this->redirectToRoute('recrutement_candidature');
        }

        $this->denyAccessUnlessGranted('ROLE_MENTOR_EXPERIMENTE', null, 'Accès refusé');

        return array(
            'controller' => 'recrutement',
            'candidature' => $candidature,
            'vote' => $vote->createView(),
            'title_action' => 'Candidature',
        );
    }

    /**
     * @Route("/recrutement/formations",name="recrutement_formation")
     * @Template("MentoratBundle/Recrutement/formation.html.twig")
     * @Method({"GET"})
     *
     * @return array
     */
    public function formationAction()
    {
        $this->denyAccessUnlessGranted('ROLE_MENTOR_EXPERIMENTE', null, 'Accès refusé');

        $candidatures = $this->get('core.recrutement')->getFormationCandidatures();

        return array(
            'controller' => 'recrutement',
            'title_action' => 'Validation de formation des nouveaux mentors',
            'candidatures' => $candidatures['candidatures_simples'],
            'candidatures_dispute' => $candidatures['candidatures_a_arbitrer'], );
    }
}
