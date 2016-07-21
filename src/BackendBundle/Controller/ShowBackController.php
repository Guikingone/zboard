<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShowBackController extends Controller
{
    /**
     * @param Request $request
     * @Route("/list/mentors", name="gestion_mentors")
     * @Template("BackBundle/Action/list_mentors.html.twig")
     */
    public function showMentorsAction(Request $request)
    {
        $mentor = $this->get('core.back')->addMentor($request);
        $mentors = $this->get('core.back')->getMentors();

        return array('mentors' => $mentors, 'mentor' => $mentor->createView());
    }

    /**
     * @param Request $request
     * @Route("/list/mentore", name="gestion_mentores")
     * @Template("BackBundle/Action/list_mentores.html.twig")
     */
    public function showMentoreAction(Request $request)
    {
        $nMentore = $this->get('core.admin')->addMentore($request);
        $mentores = $this->get('core.back')->getMentores();

        return array('mentores' => $mentores, 'nMentore' => $nMentore->createView());
    }

    /**
     * @param Request $request
     * @Route("/list/soutenances", name="gestion_soutenances")
     * @Template("BackBundle/Action/list_soutenances.html.twig")
     */
    public function showSoutenancesMentorsAction(Request $request)
    {
        $soutenance = $this->get('core.back')->addSoutenance($request);
        $soutenances = $this->get('core.back')->getSoutenances();

        return array('soutenances' => $soutenances, 'soutenance' => $soutenance->createView());
    }

    /**
     * @param Request $request
     * @Route("/list/parcours", name="gestion_parcours")
     * @template("BackBundle/Action/list_parcours.html.twig")
     */
    public function showParcoursAction(Request $request)
    {
        $parcours = $this->get('core.back')->addParcours($request);
        $path = $this->get('core.back')->getParcours();

        return array('parcours' => $parcours->createView(), 'path' => $path);
    }

    /**
     * @param $id
     *
     * @return array
     * @Route("/show/path/{id}/details", name="show_parcours")
     * @Template("BackBundle/Action/Details/show_parcours.html.twig")
     */
    public function showParcoursByIdAction(Request $request, $id)
    {
        $parcours = $this->get('core.back')->viewParcours($id);
        $projet = $this->get('core.back')->addProject($request);

        // Used to find all the projects linked to the path.
        $id = $request->attributes->get('id');

        $projets = $this->get('core.back')->getProjet($id);
        $competences = $this->get('core.back')->addCompetences($request);
        $competence = $this->getDoctrine()->getManager()->getRepository('BackendBundle:Competences')->findBy(array('projet' => $projets));

        return array('parcours' => $parcours, 'projet' => $projet->createView(),
                      'projets' => $projets, 'competence' => $competence,
                      'competences' => $competences->createView(), );
    }
}
