<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SettingsController extends Controller
{
    /**
     * @Route("/settings", name="settings")
     * @Template("BackBundle/Index/settings.html.twig")
     *
     * @return array
     */
    public function showMentorsAction()
    {
        return array('controller' => 'settings');
    }
}
