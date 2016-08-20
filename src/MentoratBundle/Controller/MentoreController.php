<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/mentore")
 */
class MentoreController extends Controller
{
    /**
     * @Route("/mes-mentores/en-cours",name="en_cours")
     * @Template("MentoratBundle/Mentore/en-cours.html.twig")
     * @Method({"GET"})
     * @return array
     */
    public function enCoursAction()
    {
        $mentores = $this->get('core.mentorat')->getMentores($this->getUser());

        return array(
            'controller'    => 'mentorat',
            'mentores'      => $mentores,
            'title_action'  => 'Mes mentorés en cours',
        );
    }

    /**
     * @Route("/mes-mentores/en-attente",name="en_attente")
     * @Template("MentoratBundle/Mentore/en-attente.html.twig")
     * @Method({"GET"})
     * @return array
     */
    public function enAttenteAction()
    {
        $mentores = $this->get('core.mentorat')->getMyWaitingMentore($this->getUser());

        return array(
            'controller'    => 'mentorat',
            'mentores'      => $mentores,
            'title_action'  => 'Mes mentorés en attente',
        );
    }

    /**
     * @Route("/mes-mentores/mentorat-termine",name="mentorat_termine")
     * @Template("MentoratBundle/Mentore/mentorat-termine.html.twig")
     * @Method({"GET"})
     * @return array
     */
    public function mentoratFinishedAction()
    {
        $mentores = $this->get('core.mentorat')->getMentoratFinished($this->getUser());

        return array(
            'controller'    => 'mentorat',
            'mentores'      => $mentores,
            'title_action'  => 'Mes mentorés terminés',
        );
    }

    /**
     * @Route("/details/{id}", name="show_details_mentore")
     * @Template("MentoratBundle/Details/show_mentores.html.twig")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param $id
     *
     * @return array
     */
    public function showProfilMentoreAction(Request $request, $id)
    {
        $mentore = $this->get('core.mentorat')->viewMentore($id);
        $note = $this->get('core.mentorat')->addNote($request, $id);
        $sessions = $this->get('core.mentorat')->addSessionMentorat($request, $id);
        $soutenance = $this->get('core.mentorat')->askSoutenance($request, $id);

        return array(
            'controller'    => 'mentore',
            'mentore'       => $mentore,
            'note'          => $note->createView(),
            'sessions'      => $sessions->createView(),
            'soutenance'    => $soutenance->createView(),
            'title_action'  => 'Détails du mentoré : '.$mentore->getFirstname().' '.$mentore->getLastname(),
        );
    }

    /**
     * @Route("/transfert/mentore/{id}", name="transfert_mentore")
     * @Template("MentoratBundle/Action/transfert_mentore.html.twig")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param $id
     *
     * @return array
     */
    public function transfertMentoreAction(Request $request, $id)
    {
        $suivi = $this->get('core.mentorat')->transfertMentore($request, $id);

        if ($suivi->isValid()) {
            return $this->redirectToRoute('show_details_mentore', array('id' => $id));
        }

        return array('controller' => 'transfert', 'title_action' => 'Transfert de mentore',
                     'suivi' => $suivi->createView(), );
    }
}
