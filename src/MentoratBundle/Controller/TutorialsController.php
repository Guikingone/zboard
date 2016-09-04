<?php

namespace MentoratBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class TutorialsController extends Controller
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
        $tutorial = $this->get('core.back')->addTutorial($request);
        $category = $this->get('core.back')->addCategory($request);

        if ($tutorial->isValid() || $category->isValid()) {
            return $this->redirectToRoute('mentorat_tutorials_index');
        }

        $tutorialCategories = $this->get('core.back')->getTutorialCategories();

        return array(
            'controller' => 'tutoriels',
            'tutorialCategories' => $tutorialCategories,
            'tutoriel' => $tutorial->createView(),
            'category' => $category->createView(),
            'title_action' => 'Tutoriels sur le mentorat',
        );
    }
}
