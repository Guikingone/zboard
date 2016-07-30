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

        $country = $this->privateContainer->get('doctrine')->getManager()->getRepository('AdminBundle:Country')
                                          ->findOneBy(array('libelle' => 'France'));


        $mentore = new Mentore();
        $mentore->setFirstname('Aurore');
        $mentore->setLastname('Gaucher');
        $mentore->setEmail('aurore.gaucher@gmail.com');
        $mentore->setAddress('Somewhere');
        $mentore->setCity('Don\'t say, somewhere near by');
        $mentore->setCountry($country);
        $mentore->setPhone('00.00.00.00.00');
        $mentore->setResume('Something');
        $mentore->setStatus('En formation');


        $mentoreC = new Mentore();
        $mentoreC->setFirstname('Toto');
        $mentoreC->setLastname('Toto');
        $mentoreC->setEmail('tyoto.toto@gmail.com');
        $mentoreC->setAddress('Somewhere');
        $mentoreC->setCity('Don\'t say, somewhere near by');
        $mentoreC->setCountry($country);
        $mentoreC->setPhone('00.00.00.00.00');
        $mentoreC->setResume('Something');
        $mentoreC->setStatus('En formation');

        $mentoreEnAttenteUn = new Mentore();
        $mentoreEnAttenteUn->setFirstname("jean-claude");
        $mentoreEnAttenteUn->setLastname("mammouth");
        $mentoreEnAttenteUn->setEmail("jc-dusse-un@gmail.com");
        $mentoreEnAttenteUn->setAddress("12 rue ici");
        $mentoreEnAttenteUn->setCity("nantes");
        $mentoreEnAttenteUn->setZipcode("44000");
        $mentoreEnAttenteUn->setPhone('00.00.00.00.01');
        $mentoreEnAttenteUn->setCountry($country);
        $mentoreEnAttenteUn->setParcours($parcours);
        $mentoreEnAttenteUn->setStatus("En attente");
        $mentoreEnAttenteUn->setResume("C'est une maison bleu, adossée à la coline !");
        $mentoreEnAttenteUn->setSuivi(null);

        $mentoreEnded = new Mentore();
        $mentoreEnded->setFirstname("jean-claude");
        $mentoreEnded->setLastname("dusse");
        $mentoreEnded->setAddress("12 rue la bas");
        $mentoreEnded->setCity("nantes");
        $mentoreEnded->setEmail("jc-dusse@gmail.com");
        $mentoreEnded->setZipcode("44000");
        $mentoreEnded->setPhone('00.00.00.00.00');
        $mentoreEnded->setCountry($country);
        $mentoreEnded->setParcours($parcoursC);
        $mentoreEnded->setStatus("Formation terminée");
        $mentoreEnded->setResume("C'est une maison bleu, adossée à la coline !");

        $suivi = new Suivi();
        $suivi->setMentor($mentor);
        $suivi->setState('IN_PROGRESS');
        $suivi->setMentore($mentore);
        $suivi->setParcours($parcours);

        $suiviAttente = new Suivi();
        $suiviAttente->setMentor($mentor);
        $suiviAttente->setState('WAITING_LIST');
        $suiviAttente->setMentore($mentoreEnAttenteUn);
        $suiviAttente->setParcours($parcours);

        $suiviOver = new Suivi();
        $suiviOver->setMentor($mentor);
        $suiviOver->setState('ENDED');
        $suiviOver->setMentore($mentoreEnded);
        $suiviOver->setParcours($parcoursC);

        $suiviC = new Suivi();
        $suiviC->setMentor($mentor);
        $suiviC->setState('IN_PROGRESS');
        $suiviC->setMentore($mentoreC);
        $suiviC->setParcours($parcoursC);

        $mentore->setSuivi($suivi);
        $mentoreC->setSuivi($suiviC);
        $mentoreEnded->setSuivi($suiviOver);

        $manager->persist($mentore);
        $manager->persist($mentoreEnAttenteUn);
        $manager->persist($mentoreEnded);
        $manager->persist($mentoreC);

        $manager->persist($suivi);
        $manager->persist($suiviC);
        $manager->persist($suiviOver);
        $manager->persist($suiviAttente);

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}
