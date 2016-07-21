<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentoratBundle\Entity\Mentore;
use MentoratBundle\Entity\Suivi;
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

        $mentor = $this->privateContainer->get('doctrine')->getManager()->getRepository('UserBundle:User')
                       ->findOneBy(array('firstName' => 'Jacky'));

        $mentore = new Mentore();
        $suivi = new Suivi();
        $suiviC = new Suivi();

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
        $mentore->setSuivi($suivi);
        $suivi->setMentor($mentor);
        $suivi->setState('En cours');
        $suivi->setMentore($mentore);
        $mentore->setStatus('En formation');
        $mentore->setFinancement(true);

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
        $mentoreC->setSuivi($suiviC);
        $suiviC->setMentor($mentor);
        $suiviC->setState('En cours');
        $suiviC->setMentore($mentoreC);
        $mentore->setFinancement(false);
        $mentoreC->setStatus('En formation');

        $manager->persist($mentore);
        $manager->persist($mentoreC);
        $manager->persist($suivi);
        $manager->persist($suiviC);
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}
