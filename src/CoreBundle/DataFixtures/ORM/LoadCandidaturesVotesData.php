<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use MentoratBundle\Entity\RecrutementVote;

class LoadCandidaturesVotesData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $candidat = $this->privateContainer->get('doctrine')->getRepository('MentoratBundle:Candidat')
                                     ->findOneBy(array('nom' => 'Chuck Norris'));
        $user = $this->privateContainer->get('doctrine')->getRepository('UserBundle:User')
                                     ->findOneBy(array('username' => 'admin'));

        $vote1 = new RecrutementVote();
        $vote1->setIdUser($user);
        $vote1->setCandidature($candidat);
        $vote1->setVote(1);
        $vote1->setCommentaire('La candidature est solide.');

        $manager->persist($vote1);

        $manager->flush();
    }

    public function getOrder()
    {
        return 18;
    }
}
