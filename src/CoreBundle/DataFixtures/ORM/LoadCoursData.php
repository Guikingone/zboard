<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 25/07/2016
 * Time: 17:03.
 */

namespace CoreBundle\DataFixtures\ORM;

use BackendBundle\Entity\Cours;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadCoursData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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

        $cours = new Cours();

        $cours->setParcours($parcours);
        $cours->setLibelle('Comprendre le web');
        $cours->setStatus(null);
        $cours->setDifficulty('Facile');
        $cours->setArchived(false);

        $manager->persist($cours);
        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
