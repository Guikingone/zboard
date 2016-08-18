<?php

namespace NotificationBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class EventsController extends Controller
{
    /**
     * @Route("/", name="show_notifications")
     * @Template("NotificationBundle/Index/index.html.twig")
     * @Method({"GET"})
     * @return array
     */
    public function indexEventsAction()
    {
        $events = $this->get('core.events')->getEvents();

        return array('controller' => 'notifications', 'title_action' => 'notifications',
                     'events' => $events, );
    }

    /**
     * @Route("/notifications/purge", name="purge_notifications")
     * @Method({"GET"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function purgeEventsAction()
    {
        $this->get('core.events')->purgeEvents();

        return $this->redirectToRoute('show_notifications');
    }
}
