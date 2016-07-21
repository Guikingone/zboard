<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentoratBundle\Entity\Mentore;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadMentoreData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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

        $parcoursC = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Parcours')
            ->findOneBy(array('libelle' => 'Développeur PHP/Symfony'));

        $abonnement = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Abonnement')
            ->findOneBy(array('libelle' => 'Premium Plus'));

        $abonnementC = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Abonnement')
            ->findOneBy(array('libelle' => 'Premium Class'));

        $mentore = new Mentore();
        $mentore->setFirstname('Aurore');
        $mentore->setLastname('Gaucher');
        $mentore->setEmail('aurore.gaucher@gmail.com');
        $mentore->setAddress('Somewhere');
        $mentore->setCity('Don\'t say, somewhere near by');
        $mentore->setCountry('FR');
        $mentore->setParcours($parcours);
        $mentore->setPhone('00.00.00.00.00');
        $mentore->setDateStart(new \DateTime());
        $mentore->setResume('Something');
        $mentore->setStatus('En formation');
        $mentore->setAbonnement($abonnement);

        $mentoreC = new Mentore();
        $mentoreC->setFirstname('Toto');
        $mentoreC->setLastname('Toto');
        $mentoreC->setEmail('tyoto.toto@gmail.com');
        $mentoreC->setAddress('Somewhere');
        $mentoreC->setCity('Don\'t say, somewhere near by');
        $mentoreC->setCountry('FR');
        $mentoreC->setParcours($parcoursC);
        $mentoreC->setPhone('00.00.00.00.00');
        $mentoreC->setDateStart(new \DateTime());
        $mentoreC->setResume('Something');
        $mentoreC->setStatus('En formation');
        $mentoreC->setAbonnement($abonnementC);

        $manager->persist($mentore);
        $manager->persist($mentoreC);
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}
