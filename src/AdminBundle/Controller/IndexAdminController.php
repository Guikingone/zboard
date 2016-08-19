<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class IndexAdminController extends Controller
{
    /**
     * @Route("/", name="home_admin")
     * @Template("AdminBundle/Index/index.html.twig")
     *
     * @return array
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
        $mentoresWaiting = $this->get('core.user')->getMentoresWaiting();
        $mentoresPlus = $this->get('core.user')->getMentoresPPlus();
        $mentoresClass = $this->get('core.user')->getMentoresPClass();

        return array(
            'controller'        => 'home',
            'mentors'           => $mentors,
            'parcoursPlus'      => $parcoursPlus,
            'parcoursClass'     => $parcoursClass,
            'projetsF'          => $projetsF,
            'projets'           => $projets,
            'soutenances'       => $soutenances,
            'notes'             => $notes,
            'sessionsC'         => $sessionsC,
            'mentoresWaiting'   => $mentoresWaiting,
            'mentoresPlus'      => $mentoresPlus,
            'mentoresClass'     => $mentoresClass,
        );
    }

    /**
     * @Route("/country", name="gestion_country")
     * @Template("AdminBundle/Action/list_country.html.twig")
     *
     * @param Request $request
     *
     * @return array
     */
    public function addCountryAction(Request $request)
    {
        $country = $this->get('core.admin')->addCountry($request);
        $countrys = $this->get('core.admin')->getCountry();

        return array(
            'controller'    => 'cms',
            'country'       => $country->createView(),
            'countrys'      => $countrys,
        );
    }

    /**
     * @Route("/habilitations", name="gestion_habilitations")
     * @Template("AdminBundle/Index/habilitations.html.twig")
     *
     * @return array
     */
    public function showHabilitationsAction()
    {
        $users = $this->get('core.user')->getMentors();
        $mentores = $this->get('core.user')->getMentores();

        return array(
            'controller'    => 'habilitations',
            'users'         => $users,
            'mentores'      => $mentores,
        );
    }

    /**
     * @Route("/show/abonnements", name="gestion_abonnements")
     * @Template("AdminBundle/Action/list_abonnements.html.twig")
     *
     * @param Request $request
     *
     * @return array
     */
    public function showAbonnementsAction(Request $request)
    {
        $abonnement = $this->get('core.admin')->addAbonnement($request);
        $abonnements = $this->get('core.admin')->getAbonnements();

        return array(
            'controller'    => 'parcours',
            'abonnements'   => $abonnements,
            'abonnement'    => $abonnement->createView(),
        );
    }
}
