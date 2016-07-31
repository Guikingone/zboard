<?php

namespace CoreBundle\DataFixtures\ORM;

use BackendBundle\Entity\Abonnement;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadAbonnementData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $abonnementPlus = new Abonnement();
        $abonnementPlus->setLibelle('Premium Plus');
        $abonnementPlus->setPrix('300€');

        $abonnementClass = new Abonnement();
        $abonnementClass->setLibelle('Premium Class');
        $abonnementClass->setPrix('90€');

        $manager->persist($abonnementPlus);
        $manager->persist($abonnementClass);
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 0;
    }
}
