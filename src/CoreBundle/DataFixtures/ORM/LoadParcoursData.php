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
        $PPlus = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Abonnement')->findOneBy(array('libelle' => 'Premium Plus'));

        $PClass = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Abonnement')->findOneBy(array('libelle' => 'Premium Class'));

        $cpmDev = new Parcours();
        $cpmDev->setLibelle('Chef de Projet Multimédia - Développement');
        $cpmDev->setDiplome('RNCP - Niveau II');
        $cpmDev->setAbonnement($PPlus);
        $cpmDev->setArchived(false);

        $cpmDes = new Parcours();
        $cpmDes->setLibelle('Chef de Projet Multimédia - Design');
        $cpmDes->setDiplome('RNCP - Niveau II');
        $cpmDes->setAbonnement($PPlus);
        $cpmDes->setArchived(false);

        $cpmMar = new Parcours();
        $cpmMar->setLibelle('Chef de Projet Multimédia - Marketing');
        $cpmMar->setDiplome('RNCP - Niveau II');
        $cpmMar->setAbonnement($PPlus);
        $cpmMar->setArchived(false);

        $devSf = new Parcours();
        $devSf->setLibelle('Développeur PHP/Symfony');
        $devSf->setAbonnement($PClass);
        $devSf->setArchived(false);

        $manager->persist($cpmDev);
        $manager->persist($cpmDes);
        $manager->persist($cpmMar);
        $manager->persist($devSf);
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}
