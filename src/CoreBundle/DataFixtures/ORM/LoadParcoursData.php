<?php
/**
 * Created by PhpStorm.
 * User: Audrophe
 * Date: 11/07/2016
 * Time: 22:53
 */
namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentoratBundle\Entity\Parcours;
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

        $cpmDev= new Parcours();
        $cpmDev->setCodeParcours("CPM-DEV");
        $cpmDev->setLibelle("Chef de Projet Multimédia - Développement");

        $cpmDes= new Parcours();
        $cpmDes->setCodeParcours("CPM-DES");
        $cpmDes->setLibelle("Chef de Projet Multimédia - Design");

        $cpmMar= new Parcours();
        $cpmMar->setCodeParcours("CPM-MAR");
        $cpmMar->setLibelle("Chef de Projet Multimédia - Marketing");

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