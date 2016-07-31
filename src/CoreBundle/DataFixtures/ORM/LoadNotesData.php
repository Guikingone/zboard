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
use MentoratBundle\Entity\Notes;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadNotesData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $suivi = $this->privateContainer->get('doctrine')->getManager()->getRepository('MentoratBundle:Suivi')
                                       ->findOneBy(array('libelle' => "Suivi Premium Plus"));

        $mentor = $this->privateContainer->get('doctrine')->getManager()->getRepository('UserBundle:User')
                                         ->findOneBy(array('firstname' => 'Jacky'));

        $note = new Notes();

        $note->setSuivi($suivi);
        $note->setAuteur($mentor);
        $note->setDateCreated(new \DateTime());
        $note->setLibelle('Une première note après la première session, rien de neuf cependant.');

        $manager->persist($note);
        $manager->flush();
    }

    public function getOrder()
    {
        return 9;
    }
}
