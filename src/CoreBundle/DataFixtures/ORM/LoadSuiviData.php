<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentoratBundle\Entity\Suivi;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadSuiviData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $mentore = $this->privateContainer->get('doctrine')->getManager()->getRepository('UserBundle:Mentore')
                                          ->findOneBy(array('lastname' => 'Gaucher'));

        $mentor = $this->privateContainer->get('doctrine')->getManager()->getRepository('UserBundle:User')
                                         ->findOneBy(array('firstname' => 'Jacky'));

        $parcours = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Parcours')
                                           ->findOneBy(array('libelle' => 'Chef de projet Multimédia - Développement'));

        $suivi = new Suivi();

        $suivi->setMentor($mentor);
        $suivi->setMentore($mentore);
        $suivi->setLibelle("Suivi Premium Plus");
        $suivi->setParcours($parcours);
        $suivi->setSuiviState('En cours');
        $suivi->setDateStart(new\DateTime());
        $suivi->setMentoreStatus('En formation');

        $manager->persist($suivi);
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}
