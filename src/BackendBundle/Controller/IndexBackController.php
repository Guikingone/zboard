<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class IndexBackController extends Controller
{
    /**
     * @Route("/", name="home_backend")
     * @Template("BackBundle/index/index.html.twig")
     */
    public function indexAction()
    {
        $mentors = $this->get('core.back')->getMentors();
        $mentores = $this->get('core.back')->getMentores();

        return array('mentors' => $mentors, 'mentores' => $mentores);
    }

    /**
     * @param Request $request
     * @Route("/list/mentors", name="gestion_mentors")
     * @Template("BackBundle/Action/list_mentors.html.twig")
     */
    public function showMentorsAction(Request $request)
    {
        $mentors = $this->get('core.back')->getMentors();
        $mentor = $this->get('core.back')->addMentor($request);

        return array('mentors' => $mentors, 'mentor' => $mentor->createView());
    }

    /**
     * @param Request $request
     * @Route("/list/mentore", name="gestion_mentores")
     * @Template("BackBundle/Action/list_mentores.html.twig")
     */
    public function showMentoreAction(Request $request)
    {
        $mentores = $this->get('core.back')->getMentores();
        $nMentore = $this->get('core.back')->addMentore($request);

        return array('mentores' => $mentores, 'nMentore' => $nMentore->createView());
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

        return array('soutenances' => $soutenances, 'soutenance' => $soutenance->createView());
    }

    /**
     * @param Request $request
     * @Route("/list/parcours", name="gestion_parcours")
     * @template("BackBundle/Action/list_parcours.html.twig")
     */
    public function showParcoursActions(Request $request)
    {
        $parcours = $this->get('core.back')->addParcours($request);
        $path = $this->get('core.back')->getParcours();
        $financeur = $this->get('core.back')->addFinancement($request);

        return array('parcours' => $parcours->createView(), 'path' => $path,
                      'financeur' => $financeur->createView(), );
    }

    /**
     * @Route("/show/{id}/details", name="show_details_mentore")
     * @Template("BackBundle/Action/Details/show_mentores.html.twig")
     * @Method("GET")
     */
    public function detailsMentoreAction($id)
    {
        $mentores = $this->get('core.back')->viewMentore($id);

        return array('mentores' => $mentores);
    }
}
