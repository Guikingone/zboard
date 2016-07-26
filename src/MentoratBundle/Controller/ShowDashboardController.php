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
     * @Route("/show/{id}/mentore/details", name="show_details_mentore")
     * @Template("BackBundle/Action/Details/show_mentores.html.twig")
     */
    public function showProfilMentoreAction(Request $request, $id)
    {
        $mentore = $this->get('core.mentore')->viewMentore($id);
        $note = $this->get('core.mentore')->addNote($request, $id);
        $sessions = $this->get('core.mentore')->addSessionMentorat($request, $id);

        return array('mentore' => $mentore, 'note' => $note->createView(),
                     'sessions' => $sessions->createView(), );
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
        $mentor = $this->get('core.mentore')->viewMentor($id);
        $sessions = $this->get('core.mentore')->getSessionsByMentor($id);
        $mentores = $this->get('core.mentore')->getMentoresbyTeacher($id);
        $competencesM = $this->get('core.admin')->addCompetencesMentor($request, $id);

        return array('mentor' => $mentor, 'competence' => $competence->createView(),
                     'competences' => $competences, 'sessions' => $sessions,
                     'mentores' => $mentores, 'competencesM' => $competencesM->createView(), );
    }
}
