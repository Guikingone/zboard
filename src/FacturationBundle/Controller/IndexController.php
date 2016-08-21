<?php

namespace FacturationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends Controller
{
    /**
     * @Route("/", name="home_facturation")
     * @Template("FacturationBundle\Index\index.html.twig")
     */
    public function indexAction()
    {
        return array('controller' => 'facturation');
    }
}
