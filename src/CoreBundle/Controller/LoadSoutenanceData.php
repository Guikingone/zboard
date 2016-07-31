<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 20/07/2016
 * Time: 19:25.
 */

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentoratBundle\Entity\Mentore;
use MentoratBundle\Entity\Soutenance;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadSoutenanceData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $mentor = $this->privateContainer->get('doctrine')->getManager()->getRepository('UserBundle:User')
                                         ->findOneBy(array('lastname' => 'Chan'));

        $mentore = $this->privateContainer->get('doctrine')->getManager()->getRepository('UserBundle:Mentore')
                                          ->findOneBy(array('lastname' => 'Gaucher'));

        $projet = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Projet')
                       ->findOneBy(array('libelle' => '[PROJET] Développez un back-end pour un client'));

        $soutenance = new Soutenance();
        $soutenance->setMentore($mentore);
        $soutenance->setProjet($projet);
        $soutenance->addMentor($mentor);
        $soutenance->setStatus('En attente');

        $manager->persist($soutenance);
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 7;
    }
}
