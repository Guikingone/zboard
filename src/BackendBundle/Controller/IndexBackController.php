<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexBackController extends Controller
{
    /**
     * @Route("/", name="home_backend")
     */
    public function indexAction()
    {
        return $this->render('BackBundle/Index/index.html.twig');
    }
}
