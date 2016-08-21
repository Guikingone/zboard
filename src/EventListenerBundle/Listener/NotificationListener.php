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

use EventListenerBundle\Event\StudentNotificationEvent;
use EventListenerBundle\Event\UserNotificationEvent;
use NotificationBundle\Services\Evenements;

class NotificationListener
{
    /**
     * @var UserNotificationEvent
     */
    private $notif;

    /**
     * NotificationListener constructor.
     *
     * @param UserNotificationEvent $event
     */
    public function __construct(Evenements $notif)
    {
        $this->notif = $notif;
    }

    public function createGlobalEvent()
    {
    }

    /**
     * Allow to create a new notification linked to a User.
     *
     * @param UserNotificationEvent $event
     */
    public function createUserEvent(UserNotificationEvent $event)
    {
        $this->notif->createUserEvents($event->getUser(), $event->getContenu(), $event->getCategorie());
    }

    /**
     * Allow to create a new notification linked to a Student.
     *
     * @param StudentNotificationEvent $event
     */
    public function createStudentEvent(StudentNotificationEvent $event)
    {
        $this->notif->createMentoreEvents($event->getMentore(), $event->getContenu(), $event->getCategorie());
    }
}
