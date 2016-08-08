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
use MentoratBundle\Entity\Suivi;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use UserBundle\Entity\Mentore;
use UserBundle\Entity\User;

class LoadMentoreData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $country = $this->privateContainer->get('doctrine')->getManager()->getRepository('AdminBundle:Country')
                                                           ->findOneBy(array('libelle' => 'France'));

        $parcours = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Parcours')
                                           ->findOneBy(array('libelle' => 'Chef de projet Multimédia - Développement'));

        $mentor = $this->privateContainer->get('doctrine')->getManager()->getRepository('UserBundle:User')
                                         ->findOneBy(array('firstname' => 'Jacky'));

        $mentore = new Mentore();

        $mentore->setUsername('Aurore');
        $mentore->setFirstname('Aurore');
        $mentore->setLastname('Gaucher');
        $mentore->setEmail('aurore.gaucher@gmail.com');
        $mentore->setCountry($country);
        $mentore->setPhone('00.00.00.00.00');
        $mentore->setPlainPassword('aurore');
        $mentore->setResume('Something');
        $mentore->setArchived(false);
        $mentore->setRoles(array('ROLE_MENTORE'));

        $mentoreC = new Mentore();

        $mentoreC->setUsername('toto');
        $mentoreC->setFirstname('Toto');
        $mentoreC->setLastname('Toto');
        $mentoreC->setEmail('tyoto.toto@gmail.com');
        $mentoreC->setCountry($country);
        $mentoreC->setPhone('00.00.00.00.00');
        $mentoreC->setPlainPassword('toto');
        $mentoreC->setResume('Something');
        $mentoreC->setArchived(false);
        $mentoreC->setRoles(array('ROLE_MENTORE'));

        $suivi = new Suivi();

        $suivi->setMentor($mentor);
        $suivi->setMentore($mentore);
        $suivi->setLibelle('Suivi Premium Plus');
        $suivi->setParcours($parcours);
        $suivi->setSuiviState('IN_PROGRESS');
        $suivi->setDateStart(new\DateTime());
        $suivi->setMentoreStatus('En formation');

        $suiviC = new Suivi();

        $suiviC->setMentor($mentor);
        $suiviC->setMentore($mentoreC);
        $suiviC->setLibelle('Suivi Premium Plus');
        $suiviC->setParcours($parcours);
        $suiviC->setSuiviState('IN_PROGRESS');
        $suiviC->setDateStart(new\DateTime());
        $suiviC->setMentoreStatus('En attente');

        $manager->persist($mentore);
        $manager->persist($mentoreC);
        $manager->persist($suivi);
        $manager->persist($suiviC);
        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
