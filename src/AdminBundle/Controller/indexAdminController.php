<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class indexAdminController extends Controller
{
    /**
     * @Route("/", name="home_admin")
     * @Template("AdminBundle/Index/index.html.twig")
     */
    public function indexAction()
    {
        $mentors = $this->get('core.user')->getMentors();
        $parcoursPlus = $this->get('core.statistiques')->getParcoursPlus();
        $parcoursClass = $this->get('core.statistiques')->getParcoursClass();
        $projets = $this->get('core.statistiques')->getProjets();
        $projetsF = $this->get('core.statistiques')->getProjetsFinished();
        $soutenances = $this->get('core.statistiques')->getSoutenances();
        $notes = $this->get('core.statistiques')->getNotesSuivi();
        $sessionsC = $this->get('core.statistiques')->getSessionsCancelled();

        return array(
            'controller' => 'home',
            'mentors' => $mentors,
            'parcoursPlus' => $parcoursPlus,
            'parcoursClass' => $parcoursClass,
            'projetsF' => $projetsF,
            'projets' => $projets,
            'soutenances' => $soutenances,
            'notes' => $notes,
            'sessionsC' => $sessionsC,
        );
    }

    /**
     * @return array
     *
     * @Route("/country", name="gestion_country")
     * @Template("AdminBundle/Action/list_country.html.twig")
     */
    public function addCountryAction(Request $request)
    {
        $country = $this->get('core.admin')->addCountry($request);
        $countrys = $this->get('core.admin')->getCountry();

        return array('controller' => 'cms', 'country' => $country->createView(),
                     'countrys' => $countrys, );
    }

    /**
     * @Route("/habilitations", name="gestion_habilitations")
     * @Template("AdminBundle/Index/habilitations.html.twig")
     */
    public function addHabilitationsAction()
    {
        return array('controller' => 'habilitations');
    }

    /**
     * @Route("/show/abonnements", name="gestion_abonnements")
     * @Template("AdminBundle/Action/list_abonnements.html.twig")
     *
     * @param Request $request
     */
    public function showAbonnementsAction(Request $request)
    {
        $abonnement = $this->get('core.admin')->addAbonnement($request);
        $abonnements = $this->get('core.admin')->getAbonnements();

        return array(
            'controller' => 'parcours',
            'abonnements' => $abonnements,
            'abonnement' => $abonnement->createView(),
        );
    }
}
