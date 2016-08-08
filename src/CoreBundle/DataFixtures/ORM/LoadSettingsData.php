<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AdminBundle\Entity\Setting;

class LoadSettingsData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $setting = new Setting();
        $setting->setNom("RECRUTEMENT_ACTIF");
        $setting->setValeur("TRUE");

        $setting_2 = new Setting();
        $setting_2->setNom("NOMBRE_NOUVEAUX_MENTORS_SOUHAITES");
        $setting_2->setValeur("10");

        $manager->persist($setting);
        $manager->persist($setting_2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 22;
    }
}
