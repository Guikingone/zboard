<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UtilsBackController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     *
     * @Route("/utils/{id}/mentors", name="update_mentors")
     * @Template("BackBundle/Action/Utils/update_mentors.html.twig")
     */
    public function updateMentorsAction(Request $request, $id)
    {
        $mentor = $this->get('core.admin')->updateMentors($request, $id);

        if ($mentor->isValid()) {
            return $this->redirectToRoute('show_details_mentor', array('id' => $id));
        }

        return array('mentor' => $mentor->createView());
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     *
     * @Route("/utils/{id}/mentores", name="update_mentores")
     * @Template("BackBundle/Action/Utils/update_mentores.html.twig")
     */
    public function updateMentoresAction(Request $request, $id)
    {
        $mentore = $this->get('core.admin')->updateMentores($request, $id);

        if ($mentore->isValid()) {
            return $this->redirectToRoute('show_details_mentore', array('id' => $id));
        }

        return array('mentore' => $mentore->createView());
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     *
     * @Route("/utils/{id}/path", name="update_parcours")
     * @Template("BackBundle/Action/Utils/update_parcours.html.twig")
     */
    public function updateParcoursAction(Request $request, $id)
    {
        $parcours = $this->get('core.admin')->updateParcours($request, $id);

        if ($parcours->isValid()) {
            return $this->redirectToRoute('show_parcours', array('id' => $id));
        }

        return array('parcours' => $parcours->createView());
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     *
     * @Route("/utils/{id}/soutenance", name="update_soutenances")
     * @Template("BackBundle/Action/Utils/update_soutenances.html.twig")
     */
    public function updateSoutenancesAction(Request $request, $id)
    {
        $soutenance = $this->get('core.admin')->updateSoutenances($request, $id);

        if ($soutenance->isValid()) {
            return $this->redirectToRoute('gestion_soutenances');
        }

        return array('soutenance' => $soutenance->createView());
    }
}
