<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/mentore")
 */
class MentoreController extends Controller
{
    /**
     * @Route("/mes-mentores/en-cours",name="en_cours")
     * @Template("MentoratBundle/Mentore/en-cours.html.twig")
     */
    public function enCoursAction()
    {
        $mentores = $this->get('core.mentore')->getMentores($this->getUser());

        return array(
            'controller' => 'mentorat',
            'mentores' => $mentores,
            'title_action' => 'Mes mentorés en cours',
        );
    }

    /**
     * @Route("/mes-mentores/en-attente",name="en_attente")
     * @Template("MentoratBundle/Mentore/en-attente.html.twig")
     */
    public function enAttenteAction()
    {
        $mentores = $this->get('core.mentore')->getMyWaitingMentore($this->getUser());

        return array(
            'controller' => 'mentorat',
            'mentores' => $mentores,
            'title_action' => 'Mes mentorés en attente',
        );
    }

    /**
     * @Route("/mes-mentores/mentorat-termine",name="mentorat_termine")
     * @Template("MentoratBundle/Mentore/mentorat-termine.html.twig")
     */
    public function mentoratFinishedAction()
    {
        $mentores = $this->get('core.mentore')->getMentoratFinished($this->getUser());

        return array(
            'controller' => 'mentorat',
            'mentores' => $mentores,
            'title_action' => 'Mes mentorés terminés',
        );
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     * @Route("/details/{id}", name="show_details_mentore")
     * @Template("MentoratBundle/Details/show_mentores.html.twig")
     */
    public function showProfilMentoreAction(Request $request, $id)
    {
        $mentore = $this->get('core.mentore')->viewMentore($id);
        $note = $this->get('core.mentor')->addNote($request, $id);
        $sessions = $this->get('core.mentore')->addSessionMentorat($request, $id);

        return array(
            'controller' => 'mentore',
            'mentore' => $mentore,
            'note' => $note->createView(),
            'sessions' => $sessions->createView(),
            'title_action' => 'Détails du mentoré : '.$mentore->getFirstname().' '.$mentore->getLastname(),
        );
    }
}
