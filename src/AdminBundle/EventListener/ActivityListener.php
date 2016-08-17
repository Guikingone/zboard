<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminBundle\EventListener;

use AdminBundle\Entity\Activity;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use UserBundle\Entity\User;
use AdminBundle\Services\ActivityManager;

class ActivityListener
{
    /**
     * @var ActivityManager
     */
    private $activity;

    /**
     * ActivityListener constructor.
     *
     * @param ActivityManager $activity
     */
    public function __construct(ActivityManager $activity)
    {
        $this->activity = $activity;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof User) {
            return;
        }

        $this->attachActivity($entity);
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof User) {
            return;
        }

        $this->attachActivity($entity);
    }

    /**
     * Allow to create a activity linked to a user.
     *
     * @param $entity   | The entity linked to the activity
     */
    public function attachActivity($entity)
    {
        if (!$entity instanceof User) {
            return;
        }

        $activity = $entity->getActivity();

        if (!$activity instanceof Activity) {
            return;
        }

        $this->activity->createActivity($entity);

        $entity->addActivity($activity);
    }
}
