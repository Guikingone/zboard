<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 20/07/2016
 * Time: 19:15.
 */

namespace CoreBundle\DataFixtures\ORM;

use BackendBundle\Entity\Projet;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadProjetsData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $parcours = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Parcours')
            ->findOneBy(array('libelle' => 'Chef de Projet Multimédia - Développement'));

        $projet = new Projet();

        $projet->setParcours($parcours);
        $projet->setLibelle('[PROJET] Développez un back-end pour un client');

        $manager->persist($projet);
        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
