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
     * @Route("/list/mentore", name="gestion_mentores")
     * @Template("BackBundle/Action/list_mentores.html.twig")
     */
    public function showMentoreAction(Request $request)
    {
        $mentore = $this->get('core.user')->addMentore($request);
        $mentores = $this->get('core.admin')->getMentores();

        return array(
            'controller' => 'users',
            'mentores' => $mentores,
            'mentore' => $mentore->createView(),
        );
    }

    /**
     * @param Request $request
     * @Route("/list/soutenances", name="gestion_soutenances")
     * @Template("BackBundle/Action/list_soutenances.html.twig")
     */
    public function showSoutenancesMentorsAction(Request $request)
    {
        $soutenances = $this->get('core.back')->getSoutenances();
        $soutenance = $this->get('core.back')->addSoutenance($request);
        return array(
            'controller' => 'soutenances',
            'soutenances' => $soutenances,
            'soutenance' => $soutenance->createView()
        );
    }

    /**
     * @param Request $request
     * @Route("/list/parcours", name="gestion_parcours")
     * @template("BackBundle/Action/list_parcours.html.twig")
     */
    public function showParcoursAction(Request $request)
    {
        $parcours = $this->get('core.admin')->addParcours($request);
        $abonnement = $this->get('core.admin')->addAbonnement($request);
        $path = $this->get('core.back')->getParcours();
        $pathArchived = $this->get('core.back')->getParcoursArchived();

        return array(
            'controller' => 'parcours',
            'parcours' => $parcours->createView(),
            'path' => $path,
            'pathArchived' => $pathArchived,
            'abonnement' => $abonnement->createView(),
        );
    }

    /**
     * @param $id
     *
     * @return array
     * @Route("/show/path/{id}/details", name="show_parcours")
     * @Template("BackBundle/Details/show_parcours.html.twig")
     */
    public function showParcoursByIdAction(Request $request, $id)
    {
        $parcours = $this->get('core.admin')->viewParcours($id);
        $projet = $this->get('core.admin')->addProject($request, $id);
        $cours = $this->get('core.admin')->addCours($request, $id);

        // Used to find all the projects linked to the path.
        $id = $request->attributes->get('id');

        $coursP = $this->get('core.admin')->getCours($id);
        $projets = $this->get('core.back')->getProjet($id);
        $competences = $this->get('core.admin')->addCompetences($request);
        $competence = $this->getDoctrine()->getManager()->getRepository('BackendBundle:Competences')
                           ->findBy(array('projet' => $projets));

        return array(
            'controller' => 'parcours',
            'parcours' => $parcours,
            'projet' => $projet->createView(),
            'projets' => $projets,
            'competence' => $competence,
            'competences' => $competences->createView(),
            'cours' => $cours->createView(),
            'coursP' => $coursP, );
    }
}
