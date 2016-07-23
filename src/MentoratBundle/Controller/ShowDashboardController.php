<?php

namespace MentoratBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShowDashboardController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     * @Route("/show/{id}/details", name="show_details_mentore")
     * @Template("BackBundle/Action/Details/show_mentores.html.twig")
     */
    public function showProfilMentoreAction(Request $request, $id)
    {
        $sessions = $this->get('core.admin')->addSessionMentorat($request, $id);
        $mentores = $this->get('core.mentore')->viewMentore($id);
        $note = $this->get('core.admin')->addNote($request, $id);
        $notes = $this->get('core.mentore')->getNotesByStudent($id);
        $session = $this->get('core.admin')->getSessionsByMentore($id);

        return array('mentores' => $mentores, 'note' => $note->createView(),
                     'notes' => $notes, 'sessions' => $sessions->createView(),
                     'session' => $session, );
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     * @Route("/show/{id}/mentor/details", name="show_details_mentor")
     * @Template("BackBundle/Action/Details/show_mentors.html.twig")
     */
    public function showProfilMentorAction(Request $request, $id)
    {
        $competence = $this->get('core.admin')->addCompetencesMentor($request, $id);
        $competences = $this->get('core.admin')->getMentorCompetences($id);
        $mentor = $this->get('core.admin')->viewMentor($id);
        $sessions = $this->get('core.admin')->getSessionsByMentor($id);
        $mentores = $this->get('core.admin')->getMentoresbyTeacher($id);
        $competencesM = $this->get('core.admin')->addCompetencesMentor($request, $id);

        return array('mentor' => $mentor, 'competence' => $competence->createView(),
                     'competences' => $competences, 'sessions' => $sessions,
                     'mentores' => $mentores, 'competencesM' => $competencesM->createView(), );
    }
}
