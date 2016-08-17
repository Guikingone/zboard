<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use MentoratBundle\Entity\FormationEtapeUser;

class LoadFormationEtapesUserData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user = $this->privateContainer->get('doctrine')->getManager()->getRepository('UserBundle:User')
                                      ->findOneBy(array('username' => 'michael'));
        $etape = $this->privateContainer->get('doctrine')->getManager()->getRepository('MentoratBundle:FormationEtape')
                                    ->findOneBy(array('etape' => 'J\'ai accès aux channels slack'));
        $etape_2 = $this->privateContainer->get('doctrine')->getManager()->getRepository('MentoratBundle:FormationEtape')
                                   ->findOneBy(array('etape' => 'J\'ai listé mes compétences dans l\'onglet profil'));
        $etape1 = new FormationEtapeUser();
        $etape1->setIdUser($user);
        $etape1->setIdEtape($etape);

        $etape4 = new FormationEtapeUser();
        $etape4->setIdUser($user);
        $etape4->setIdEtape($etape_2);
        $etape4->setContent('http://openclassrooms.com');

        $manager->persist($etape1);
        $manager->persist($etape4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 16;
    }
}
