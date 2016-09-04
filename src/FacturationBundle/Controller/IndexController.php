<?php

namespace FacturationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends Controller
{
    /**
     * @Route("/", name="home_facturation")
     * @Template("FacturationBundle\Index\index.html.twig")
     * @Method("GET")
     *
     * @return array
     */
    public function indexAction()
    {
        return array('controller' => 'facturation');
    }

    /**
     * @Route("/facturation/mentor", name="home_facturation_mentor")
     * @Method("GET")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function generateFactureMentorAction()
    {
        $this->get('core.facturation')->generateMentorFacture($this->getUser()->getId());

        return $this->redirectToRoute('show_details_mentor', array('id' => $this->getUser()->getId()));
    }

    /**
     * @Route("/generate/facturation", name="facturation_generation")
     * @Method({"GET", "POST"})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function generateFacturationAction()
    {
        return $this->redirectToRoute('home_facturation');
    }
}
