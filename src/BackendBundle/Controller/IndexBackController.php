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
    public function indexAction(Request $request)
    {
        $mentors    = $this->get('core.back')->getMentors();
        $mentores   = $this->get('core.back')->getMentores();
        return array( 'mentors' => $mentors, 'mentores' => $mentores );
    }

    /**
     * @Route("/list/mentors", name="gestion_mentors")
     * @Template("BackBundle/Action/list_mentors.html.twig")
     * @Method("GET")
     */
    public function showMentorsAction(Request $request)
    {
        $mentors    = $this->get('core.back')->getMentors();
        $mentor     = $this->get('core.back')->addMentor($request);
        return array( 'mentors' => $mentors, 'mentor' => $mentor->createView() );
    }

    /**
     * @Route("/list/soutenances", name="gestion_soutenances")
     * @Template("BackBundle/Action/list_soutenances.html.twig")
     */
    public function showSoutenancesMentorsAction()
    {

    }

    /**
     * @Route("/list/mentore", name="gestion_mentores")
     * @Template("BackBundle/Action/list_mentores.html.twig")
     * @Method("GET")
     */
    public function showMentoreAction(Request $request)
    {
        $mentores   = $this->get('core.back')->getMentores();
        $nMentore   = $this->get('core.back')->addMentore($request);
        $parcours   = $this->get('core.back')->addParcours($request);
        $financeur  = $this->get('core.back')->addFinancement($request);
        $pays       = $this->get('core.back')->addCountry($request);
        $projet     = $this->get('core.back')->addProject($request);
        return array( 'mentores' => $mentores, 'nMentore' => $nMentore->createView(),
                      'parcours' => $parcours->createView(), 'financeur' => $financeur->createView(),
                      'pays' => $pays->createView(), 'projet' => $projet->createView() );
    }

    /**
     * @Route("/show/{id}/details", name="show_details_mentore")
     * @Template("BackBundle/Action/details.html.twig")
     * @Method("GET")
     */
    public function detailsMentoreAction($id)
    {
        $mentores = $this->get('core.back')->viewMentore($id);
        return array( 'mentores' => $mentores );
    }
}
