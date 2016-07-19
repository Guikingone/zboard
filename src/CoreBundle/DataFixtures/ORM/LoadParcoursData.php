<?php
/**
 * Created by PhpStorm.
 * User: Audrophe
 * Date: 11/07/2016
 * Time: 22:53.
 */

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\Parcours;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadParcoursData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $cpmDev = new Parcours();
        $cpmDev->setLibelle('Chef de Projet Multimédia - Développement');
        $cpmDev->setAbonnement('Premium Plus');

        $cpmDes = new Parcours();
        $cpmDes->setLibelle('Chef de Projet Multimédia - Design');
        $cpmDev->setAbonnement('Premium Plus');

        $cpmMar = new Parcours();
        $cpmMar->setLibelle('Chef de Projet Multimédia - Marketing');
        $cpmDev->setAbonnement('Premium Plus');

        $manager->persist($cpmDev);
        $manager->persist($cpmDes);
        $manager->persist($cpmMar);
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}
