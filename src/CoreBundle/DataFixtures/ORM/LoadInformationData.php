<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BackendBundle\Entity\InformationMentorat;

class LoadInformationData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user = $this->privateContainer->get('doctrine')->getRepository('UserBundle:User')
                                       ->findOneBy(array('lastName' => 'Chan'));

        $info = new InformationMentorat();
        $info->setTitle('Première news !');
        $info->setBody("C'est parti pour une graannnde aventure !");
        $info->setDCreated(new \DateTime());
        $info->setUpdated(new \DateTime());
        $info->setEnabled(true);
        $info->setAuthor($user);

        $info_2 = new InformationMentorat();
        $info_2->setTitle('Pourquoi ?');
        $info_2->setBody('Parce que');
        $info_2->setDCreated(new \DateTime());
        $info_2->setUpdated(new \DateTime());
        $info_2->setEnabled(true);
        $info_2->setAuthor($user);

        $manager->persist($info);
        $manager->persist($info_2);

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 7;
    }
}
