<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 25/07/2016
 * Time: 17:03.
 */

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MentoratBundle\Entity\Sessions;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadSessionsData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $mentore = $this->privateContainer->get('doctrine')->getManager()->getRepository('UserBundle:User')
                                        ->findOneBy(array('lastname' => 'Gaucher'));

        $mentor = $this->privateContainer->get('doctrine')->getManager()->getRepository('UserBundle:User')
            ->findOneBy(array('lastname' => 'Chan'));

        $session = new Sessions();

        $session->addUser($mentor);
        $session->setDateSession(new \DateTime());
        $session->setPeriodicity(false);
        $session->setStatus('Present');
        $session->setLibelle('Session de mentorat Premium Plus');

        $manager->persist($session);
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}
