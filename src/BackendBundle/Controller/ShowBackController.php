<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShowBackController extends Controller
{
    /**
     * @Route("/list/mentors", name="gestion_mentors")
     * @Template("BackBundle/Action/list_mentors.html.twig")
     *
     * @param Request $request
     *
     * @return array
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
     * @Route("/list/mentore", name="gestion_mentores")
     * @Template("BackBundle/Action/list_mentores.html.twig")
     *
     * @param Request $request
     *
     * @return array
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
     * @Route("/list/soutenances", name="gestion_soutenances")
     * @Template("BackBundle/Action/list_soutenances.html.twig")
     *
     * @param Request $request
     *
     * @return array
     */
    public function showSoutenancesMentorsAction(Request $request)
    {
        $soutenance = $this->get('core.back')->addSoutenance($request);
        $soutenancesWaiting = $this->get('core.statistiques')->getSoutenancesWaiting();
        $soutenancesAsked = $this->get('core.statistiques')->getDemandesSoutenances();
        $soutenancesInProgress = $this->get('core.statistiques')->getSoutenancesInProgress();
        $soutenancesFinished = $this->get('core.statistiques')->getSoutenancesFinished();

        return array(
            'controller' => 'soutenances',
            'soutenancesWaiting' => $soutenancesWaiting,
            'soutenance' => $soutenance->createView(),
            'soutenancesAsked' => $soutenancesAsked,
            'soutenancesInProgress' => $soutenancesInProgress,
            'soutenancesFinished' => $soutenancesFinished,
        );
    }

    /**
     * @Route("/list/parcours", name="gestion_parcours")
     * @template("BackBundle/Action/list_parcours.html.twig")
     *
     * @param Request $request
     *
     * @return array
     */
    public function showParcoursAction(Request $request)
    {
        $parcours = $this->get('core.admin')->addParcours($request);
        $abonnement = $this->get('core.admin')->addAbonnement($request);
        $path = $this->get('core.statistiques')->getParcours();

        return array(
            'controller' => 'parcours',
            'parcours' => $parcours->createView(),
            'path' => $path,
            'abonnement' => $abonnement->createView(),
        );
    }

    /**
     * @Route("/show/path/{id}/details", name="show_parcours")
     * @Template("BackBundle/Details/show_parcours.html.twig")
     *
     * @param $id
     *
     * @return array
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
