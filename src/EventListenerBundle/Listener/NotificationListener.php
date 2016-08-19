<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EventListenerBundle\Listener;

use EventListenerBundle\Event\NotificationEvent;
use NotificationBundle\Services\Evenements;

class NotificationListener
{
    /**
     * @var NotificationEvent
     */
    private $event;

    /**
     * NotificationListener constructor.
     *
     * @param NotificationEvent $event
     */
    public function __construct(Evenements $event)
    {
        $this->event = $event;
    }

    /**
     * Allow to create a new notification.
     *
     * @param NotificationEvent $evet
     */
    public function createEvent(NotificationEvent $evet)
    {
        if(in_array($evet->getContenu(),$evet->getCategorie(), $evet->getUser())) {
            $this->event->createUserEvents($evet->getUser(), $evet->getContenu(), $evet->getCategorie());
        }
    }
}
