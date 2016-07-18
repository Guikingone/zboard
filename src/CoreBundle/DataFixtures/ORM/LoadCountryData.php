<?php
/**
 * Created by PhpStorm.
 * User: Audrophe
 * Date: 11/07/2016
 * Time: 22:53.
 */

namespace CoreBundle\DataFixtures\ORM;

use BackendBundle\Entity\Country;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCountryData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $france = new Country();
        $france->setLibelle('france');

        $canada = new Country();
        $canada->setLibelle('canada');

        $manager->persist($france);
        $manager->persist($canada);
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}
