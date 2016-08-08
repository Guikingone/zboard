<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use MentoratBundle\Entity\RecrutementQuestion;

class LoadRecrutementQuestionsData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $question1 = new RecrutementQuestion();
        $question1->setContenu('Quelles sont tes compétences ?');
        $question1->setTypeAnswer('array');

        $question2 = new RecrutementQuestion();
        $question2->setContenu('Parles nous un peu de ce qui te motive');
        $question2->setTypeAnswer('text');

        $manager->persist($question1);
        $manager->persist($question2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 20;
    }
}
