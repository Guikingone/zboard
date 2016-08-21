<?php

namespace MentoratBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class TutorielsController extends Controller
{
    /**
     * @Route("/tutoriels")
     * @Template("MentoratBundle/Dashboard/tutoriels.html.twig")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $tutoriel = $this->get('core.back')->addTutorial($request);

        if ($tutoriel->isValid()) {
            return $this->redirectToRoute('mentorat_tutoriels_index');
        }

        $tutoriels = $this->get('core.back')->getTutorials();

        return array(
            'controller' => 'tutoriels',
            'tutoriels' => $tutoriels,
            'tutoriel' => $tutoriel->createView(),
            'title_action' => 'Tutoriels sur le mentorat',
        );
    }
}
