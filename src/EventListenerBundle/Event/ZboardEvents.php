<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EventListenerBundle\Event;

final class ZboardEvents
{
    /**
     * Allow to notify the user when his account is created and activated.
     *
     * @Event("EventListenerBundle\Event\NotificationEvent")
     */
    const CREATE_USER = 'zboard.create_user';

    /**
     * Allow to notify all the teacher and admin's that the process of facturation has been launched.
     *
     * @Event("/EventListenerBundle\Event\FacturationEvent")
     */
    const FACTURATION_LAUNCHED = 'zboard.facturation_launched';

    /**
     * Allow to notify the student when his account is created and activated.
     */
    const CREATE_STUDENT = 'zboard.create_student';

    /**
     * Allow to notify the teacher and the student that a new soutenance has been created.
     */
    const CREATE_SOUTENANCE = 'zboard.create_soutenance';

    /**
     * Allow to notify all the users that a new paths has been created.
     */
    const CREATE_PATH = 'zboard.create_path';

    /**
     * Allow to notify all the users that a new projects has been added into a path.
     */
    const CREATE_PROJECT = 'zboard.create_project';

    /**
     * Allow to notify all the users that a new courses has been added into a path.
     */
    const CREATE_COURSES = 'zboard.create_courses';
}
