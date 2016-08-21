<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NotificationBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpFoundation\Session\Session;
use AdminBundle\Services\Mail;
use NotificationBundle\Entity\Events;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @var Session
     */
    private $session;

    /**
     * @var Mail
     */
    private $mail;

    /**
     * Evenements constructor.
     *
     * @param EntityManager $doctrine
     * @param TokenStorage  $user
     */
    public function __construct(EntityManager $doctrine, TokenStorage $user, Session $session, Mail $mail)
    {
        $this->doctrine = $doctrine;
        $this->user = $user;
        $this->session = $session;
        $this->mail = $mail;
    }

    /**
     * Allow to get all the notifications linked to a user.
     *
     * @return array|\NotificationBundle\Entity\Events[]
     */
    public function getEvents()
    {
        return $this->doctrine->getRepository('NotificationBundle:Events')
                              ->getEventsByUser($this->user->getToken()->getUser());
    }

    /**
     * Allow to create a event who's gonna be linked to all teachers|users and students.
     *
     * @param $libelle      | The libelle of the event
     * @param $categorie    | The category of the event
     */
    public function createEvents($libelle, $categorie)
    {
        $users = $this->doctrine->getRepository('UserBundle:User')->findAll();

        $students = $this->doctrine->getRepository('UserBundle:Mentore')->findAll();

        $event = new Events();

        foreach ($users as $user) {
            $event->setDate(new \DateTime());
            $event->setLibelle($libelle);
            $event->setCategorie($categorie);
            $event->addUser($user);
            $user->addEvent($event);
        }

        foreach ($students as $student) {
            $event->setDate(new \DateTime());
            $event->setLibelle($libelle);
            $event->setCategorie($categorie);
            $event->addMentore($student);
            $student->addEvent($event);
        }

        $this->doctrine->persist($event);
        $this->doctrine->flush();
    }

    /**
     * Allow to create and link a event to a simple user || teacher.
     *
     * @param $user         | The user who receive the event
     * @param $libelle      | The libelle of the event
     * @param $categorie    | The categorie of the event
     */
    public function createUserEvents($user, $libelle, $categorie)
    {
        $user = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $user));

        if (null === $user) {
            throw new Exception("L'utilisateur ne semble pas exister.");
        }

        $event = new Events();

        $event->setLibelle($libelle);
        $event->setCategorie($categorie);
        $event->setDate(new \Datetime());
        $event->addUser($user);
        $user->addEvent($event);

        $this->doctrine->persist($event);
        $this->doctrine->flush();
    }

    /**
     * Allow to create and link a event to a student.
     *
     * @param $user         | The student who receive the event
     * @param $libelle      | The libelle of the event
     * @param $categorie    | The category of the event
     */
    public function createMentoreEvents($user, $libelle, $categorie)
    {
        $user = $this->doctrine->getRepository('UserBundle:Mentore')->findOneBy(array('id' => $user));

        if (null === $user) {
            throw new Exception("L'élève ne semble pas exister.");
        }

        $event = new Events();

        $event->setLibelle($libelle);
        $event->setCategorie($categorie);
        $event->setDate(new \DateTime());
        $event->addMentore($user);
        $user->addEvent($event);

        $this->doctrine->persist($event);
        $this->doctrine->flush();
    }

    /**
     * Allow to delete all the events linked to a user.
     */
    public function purgeEvents()
    {
        $events = $this->doctrine->getRepository('NotificationBundle:Events')
                                 ->getEventsByUser($this->user->getToken()->getUser());
        if (null === $events) {
            throw new NotFoundHttpException('Les évènements semble ne pas exister');
        }

        foreach ($events as $event) {
            $this->doctrine->remove($event);
        }
        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Les notifications ont bien été supprimées.');
    }
}
