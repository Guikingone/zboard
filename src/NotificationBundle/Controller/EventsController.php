<?php

namespace NotificationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends Controller
{
    /**
     * @Route("/", name="show_notifications")
     * @Template("NotificationBundle/Index/index.html.twig")
     */
    public function indexEventsAction()
    {
        $events = $this->get('core.events')->getEvents();

        return array('controller' => 'notifications', 'events' => $events);
    }
}
