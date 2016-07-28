<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ArchiveController extends Controller
{
    /**
     * @Route("/archives", name="home_archives")
     * @Template("AdminBundle/Index/archives.html.twig")
     */
    public function indexAction()
    {
        $mentor = $this->get('core.archive')->getMentorArchived();
        return array('controller' => 'archives', 'mentor' => $mentor);
    }
}
