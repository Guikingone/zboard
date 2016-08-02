<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 02/08/2016
 * Time: 09:14
 */

namespace NotificationBundle\Services;

use Doctrine\ORM\EntityManager;
use NotificationBundle\Entity\Events;

class Evenements
{
    /**
     * @var EntityManager
     */
    private $doctrine;

    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function createEvents($libelle, $categorie)
    {
        $event = new Events();
        $event->setDate(new \DateTime());
        $event->setLibelle($libelle);
        $event->setCategorie($categorie);

        $this->doctrine->persist($event);
        $this->doctrine->flush();
    }
}