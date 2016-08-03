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
     *
     * @return array
     *
     * @Route("/list/mentors", name="gestion_mentors")
     * @Template("BackBundle/Action/list_mentors.html.twig")
     */
    public function showMentorsAction(Request $request)
    {
        $mentor = $this->get('core.user')->addMentor($request);
        $mentors = $this->get('core.user')->getMentors();

        return array(
            'controller' => 'users',
            'mentors' => $mentors,
            'mentor' => $mentor->createView(),
        );
    }

    /**
     * @param Request $request
     *
     * @return array
     *
     * @Route("/list/mentore", name="gestion_mentores")
     * @Template("BackBundle/Action/list_mentores.html.twig")
     */
    public function showMentoreAction(Request $request)
    {
        $mentore = $this->get('core.user')->addMentore($request);
        $mentores = $this->get('core.user')->getMentores();

        return array(
            'controller' => 'users',
            'mentores' => $mentores,
            'mentore' => $mentore->createView(),
        );
    }

    /**
     * @param Request $request
     *
     * @return array
     *
     * @Route("/list/soutenances", name="gestion_soutenances")
     * @Template("BackBundle/Action/list_soutenances.html.twig")
     */
    public function showSoutenancesMentorsAction(Request $request)
    {
        $soutenance = $this->get('core.back')->addSoutenance($request);
        $soutenances = $this->get('core.back')->getSoutenances();

        return array(
            'controller' => 'soutenances',
            'soutenances' => $soutenances,
            'soutenance' => $soutenance->createView(),
        );
    }

    /**
     * @param Request $request
     *
     * @return array
     *
     * @Route("/list/parcours", name="gestion_parcours")
     * @template("BackBundle/Action/list_parcours.html.twig")
     */
    public function showParcoursAction(Request $request)
    {
        $parcours = $this->get('core.admin')->addParcours($request);
        $abonnement = $this->get('core.admin')->addAbonnement($request);
        $path = $this->get('core.back')->getParcours();

        return array(
            'controller' => 'parcours',
            'parcours' => $parcours->createView(),
            'path' => $path,
            'abonnement' => $abonnement->createView(),
        );
    }

    /**
     * @param $id
     *
     * @return array
     *
     * @Route("/show/path/{id}/details", name="show_parcours")
     * @Template("BackBundle/Details/show_parcours.html.twig")
     */
    public function showParcoursByIdAction(Request $request, $id)
    {
        $parcours = $this->get('core.admin')->viewParcours($id);
        $projet = $this->get('core.admin')->addProject($request, $id);
        $cours = $this->get('core.admin')->addCours($request, $id);
        $competences = $this->get('core.admin')->addCompetences($request);

        return array(
            'controller' => 'parcours',
            'parcours' => $parcours,
            'projet' => $projet->createView(),
            'competences' => $competences->createView(),
            'cours' => $cours->createView(), );
    }
}
