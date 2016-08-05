<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use MentoratBundle\Entity\Candidat;

class LoadCandidaturesData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $candidature1 = new Candidat();
        $candidature1->setNom("Chuck Norris");
        $candidature1->setEmail("chucknorris@yopmail.fr");
        $candidature1->setDateCandidature(new \DateTime());
        $candidature1->setCompetences(array("Julia","Batch"));
        $candidature1->setMotivation("Je suis motivé et c'est tout");

        $manager->persist($candidature1);

        $manager->flush();
    }

    public function getOrder()
    {
        return 17;
    }
}
