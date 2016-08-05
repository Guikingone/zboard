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
use Symfony\Component\Config\Definition\Exception\Exception;
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
     * @param TokenStorage $user
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
    public function createEvents($libelle, $categorie)
    {
        $users = $this->doctrine->getRepository('UserBundle:User')->findAll();

        $event = new Events();

        foreach ($users as $user) {
            $event->setDate(new \DateTime());
            $event->setLibelle($libelle);
            $event->setCategorie($categorie);
            $event->addUser($user);
            $user->addEvent($event);
        }
        $this->doctrine->persist($event);
        $this->doctrine->flush();
    }

    /**
     * Allow to create and link a event to a simple user.
     *
     * @param $user
     * @param $libelle
     * @param $categorie
     */
    public function createEventsToUser($user, $libelle, $categorie)
    {
        $users = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $user));

        if (null === $users) {
            throw new Exception("L'utilisateur ne semble pas exister.");
        }

        $event = new Events();

        $event->setLibelle($libelle);
        $event->setCategorie($categorie);
        $event->setDate(new \Datetime());
        $event->addUser($users);
        $users->addEvent($event);

        $this->doctrine->persist($event);
        $this->doctrine->flush();
    }

    /**
     * Allow to delete all the events linked to a user.
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
            $this->doctrine->flush();
        }
    }
}
