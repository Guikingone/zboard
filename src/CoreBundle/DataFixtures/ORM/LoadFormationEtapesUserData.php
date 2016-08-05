<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use MentoratBundle\Entity\FormationEtapeUser;

class LoadFormationEtapesUserData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $etape1 = new FormationEtapeUser();
        $etape1->setIdUser(4);
        $etape1->setIdEtape(1);

        $etape4 = new FormationEtapeUser();
        $etape4->setIdUser(4);
        $etape4->setIdEtape(4);
        $etape4->setContent('http://openclassrooms.com');

        $manager->persist($etape1);
        $manager->persist($etape4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 16;
    }
}
