<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SettingsController extends Controller
{
    /**
     * @Route("/settings", name="settings")
     * @Template("BackBundle/Index/settings.html.twig")
     * @Method({"GET"})
     * @return array
     */
    public function showMentorsAction()
    {
        return array('controller' => 'settings');
    }
}
