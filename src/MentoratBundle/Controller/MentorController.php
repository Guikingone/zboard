<?php

namespace MentoratBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/mentor")
 * Class MentorController
 */
class MentorController extends Controller
{
    /**
     * @Route("/{page}",name="list_mentors",defaults={"page" = 1})
     * @Template("MentoratBundle/Mentors/list_mentors.html.twig")
     *
     * @return array
     */
    public function listAction($page)
    {
        $mentors = $this->get('core.mentorat')->getUserByRoleMentor($page, 20);
        $nbMentors = $this->get('core.mentorat')->countMentors();

        $pagination = array(
            'page'          => $page,
            'route'         => 'list_mentors',
            'pages_count'   => ceil($nbMentors / 20),
            'route_params'  => array(),
        );

        return array(
            'controller'    => 'mentors',
            'mentors'       => $mentors,
            'pagination'    => $pagination,
            'title_action'  => 'Liste des mentors',
        );
    }

    /**
     * @Route("/details/{id}", name="show_details_mentor")
     * @Template("MentoratBundle/Details/show_mentors.html.twig")
     *
     * @param Request $request
     * @param $id
     *
     * @return array
     */
    public function showProfilMentorAction(Request $request, $id)
    {
        $competence = $this->get('core.user')->addCompetencesMentor($request, $id);
        $mentor = $this->get('core.mentorat')->viewMentor($id);
        $nbSoutenances = $this->get('core.mentorat')->countSoutenancesDone($this->getUser());
        $nbMentores = $this->get('core.mentorat')->countMentoreByMentor($this->getUser());

        return array(
            'controller'    => 'mentor',
            'mentor'        => $mentor,
            'competence'    => $competence->createView(),
            'nbSoutenances' => $nbSoutenances,
            'nbMentores'    => $nbMentores,
            'title_action'  => 'Détails du mentor :'.$mentor->getFirstname().' '.$mentor->getLastname(),
        );
    }

    /**
     * @Route("/profile/edit", name="zboard_teacher_profile_edit")
     * @Template("UserBundle/Profile/edit.html.twig")
     *
     * @return array
     */
    public function editProfilMentorAction(Request $request)
    {
        $user = $this->get('core.user')->updateUserProfile($request, $this->getUser());
        $competence = $this->get('core.user')->addCompetencesMentor($request, $this->getUser());

        return array(
            'user'          => $user->createView(),
            'competence'    => $competence->createView(),
            'controller'    => 'user',
            'title_action'  => 'Mon profil',
        );
    }

    /**
     * @Route("/indispo/{id}", name="mentor_indispo")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function mentorIndispoAction($id)
    {
        $this->get('core.mentorat')->mentorIndispo($id);

        return $this->redirectToRoute('show_details_mentor', array('id' => $id));
    }

    /**
     * @Route("/dispo/{id}", name="mentor_dispo")
     * @Method({"GET"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function mentorDispoAction($id)
    {
        $this->get('core.mentorat')->mentorDispo($id);

        return $this->redirectToRoute('show_details_mentor', array('id' => $id));
    }
}
