<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminBundle\Services;

use AdminBundle\Entity\Activity;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;
use UserBundle\Entity\Mentore;
use UserBundle\Entity\User;

class ActivityManager
{
    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * ActivityManager constructor.
     *
     * @param EntityManager $doctrine
     */
    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Allow to create a new Activity linked to a user|student using the id passed through the method.
     *
     * @param $id   | The id of the user || student.
     */
    public function createActivity($id)
    {
        $activity = new Activity();
        $activity->setDate(new \DateTime());

        if (!$id instanceof User || !$id instanceof Mentore) {
            throw new Exception("Oups, It seems like we've a problem houston !");
        }

        switch ($id) {
            case $id instanceof User:
                $user = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));
                $activity->addUser($user);
                $user->addActivity($activity);

                $this->doctrine->persist($activity);
                $this->doctrine->flush();
                break;
            case $id instanceof Mentore:
                $mentore = $this->doctrine->getRepository('UserBundle:Mentore')->findOneBy(array('id' => $id));
                $activity->addMentore($mentore);
                $mentore->addActivity($activity);

                $this->doctrine->persist($activity);
                $this->doctrine->flush();
                break;
            default:
                throw new Exception('Oups, Vous n\'êtes pas du coin non ?');
        }
    }
}
