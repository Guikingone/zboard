<?php

namespace MentoratBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mentor")
 * Class MentorController
 * @package MentoratBundle\Controller
 */
class MentorController extends Controller
{

    /**
     * @Route("/{page}",name="list_mentors",defaults={"page" = 1})
     * @Template("MentoratBundle/Mentors/list_mentors.html.twig")
     */
    public function listAction($page)
    {
        $mentors = $this->get('core.mentor')->getUserByRoleMentor($page,20);
        $nbMentors = $this->get('core.mentor')->countMentors();

        $pagination = array(
            'page' => $page,
            'route' => 'list_mentors',
            'pages_count' => ceil($nbMentors / 20),
            'route_params' => array()
        );

        return array(
            'controller'    => 'mentors',
            'mentors'       => $mentors,
            'pagination'    => $pagination,
            'title_action'  => "Liste des mentors"
        );
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     * @Route("/details/{id}", name="show_details_mentor")
     * @Template("MentoratBundle/Details/show_mentors.html.twig")
     */
    public function showProfilMentorAction(Request $request, $id)
    {
        $competence = $this->get('core.user')->addCompetencesMentor($request, $id);
        $mentor = $this->get('core.mentore')->viewMentor($id);

        return array(
            'controller'    => 'mentor',
            'mentor'        => $mentor,
            'competence'    => $competence->createView(),
            'title_action'  => "Détails du mentor :" . $mentor->getFirstname() . " " . $mentor->getLastname()
        );
    }
}
