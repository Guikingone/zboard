<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BackendBundle\Entity\Tutoriel;

class LoadTutorielsData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $tutoriel = new Tutoriel();
        $tutoriel->setTitle('Devenez mentor');
        $tutoriel->setLink('https://openclassrooms.com/courses/devenez-mentor-sur-openclassrooms/');

        $manager->persist($tutoriel);

        $manager->flush();
    }

    public function getOrder()
    {
        return 14;
    }
}
