<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShowBackController extends Controller
{
    /**
     * @param $id
     *
     * @return array
     * @Route("/show/path/{id}/details", name="show_parcours")
     * @Template("BackBundle/Action/Details/show_parcours.html.twig")
     */
    public function showParcours(Request $request, $id)
    {
        $parcours = $this->get('core.back')->viewParcours($id);
        $projet = $this->get('core.back')->addProject($request);

        // Used to find all the projects linked to the path.
        $id = $request->attributes->get('id');

        $projets = $this->get('core.back')->getProjet($id);
        $competence = $this->getDoctrine()->getManager()->getRepository('BackendBundle:Competences')->findBy(array('projet' => $projets));
        $competences = $this->get('core.back')->addCompetences($request);

        return array('parcours' => $parcours, 'projet' => $projet->createView(),
                      'projets' => $projets, 'competence' => $competence,
                      'competences' => $competences->createView(), );
    }
}
