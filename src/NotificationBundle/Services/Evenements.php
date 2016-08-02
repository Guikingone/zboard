<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 02/08/2016
 * Time: 09:14.
 */

namespace NotificationBundle\Services;

use Doctrine\ORM\EntityManager;
use NotificationBundle\Entity\Events;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class Evenements
{
    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * @var TokenStorage
     */
    private $user;

    /**
     * Evenements constructor.
     *
     * @param EntityManager $doctrine
     * @param TokenStorage  $user
     */
    public function __construct(EntityManager $doctrine, TokenStorage $user)
    {
        $this->doctrine = $doctrine;
        $this->user = $user;
    }

    /**
     * Allow to get all the notifications linked to a user.
     *
     * @return array|\NotificationBundle\Entity\Events[]
     */
    public function getEvents()
    {
        return $this->doctrine->getRepository('NotificationBundle:Events')
                              ->findBy(array('user' => $this->user->getToken()->getUser()));
    }

    /**
     * Allow to create a events.
     *
     * @param $libelle
     * @param $categorie
     */
    public function createEvents($libelle, $categorie, $user)
    {
        $event = new Events();
        $event->setDate(new \DateTime());
        $event->setLibelle($libelle);
        $event->setCategorie($categorie);
        $event->setUser($user);

        $this->doctrine->persist($event);
        $this->doctrine->flush();
    }

    /**
     * Allow to delete all the events linekd to a user.
     */
    public function purgeEvents()
    {
        $events = $this->doctrine->getRepository('NotificationBundle:Events')
                                 ->findBy(array('user' => $this->user->getToken()->getUser()));
        if (null === $events) {
            throw new NotFoundHttpException('Les évènements semble ne pas exister');
        }

        foreach ($events as $event) {
            $this->doctrine->remove($event);
        }
    }
}
