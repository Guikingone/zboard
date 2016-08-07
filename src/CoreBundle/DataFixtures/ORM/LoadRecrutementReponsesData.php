<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use MentoratBundle\Entity\RecrutementReponse;

class LoadRecrutementReponsesData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $question1 = $this->privateContainer->get('doctrine')->getRepository('MentoratBundle:RecrutementQuestion')
                                    ->findOneBy(array('contenu' => 'Quelles sont tes compétences ?'));
        $question2 = $this->privateContainer->get('doctrine')->getRepository('MentoratBundle:RecrutementQuestion')
                                    ->findOneBy(array('contenu' => 'Parles nous un peu de ce qui te motive'));


        // Candidat 1
        $candidat1 = $this->privateContainer->get('doctrine')->getRepository('MentoratBundle:Candidat')
                                    ->findOneBy(array('nom' => 'Chuck Norris'));

        $reponse1 = new RecrutementReponse();
        $reponse1->setIdCandidature($candidat1);
        $reponse1->setIdQuestion($question1);
        $reponse1->setContenu("Julia;Batch");

        $reponse2 = new RecrutementReponse();
        $reponse2->setIdCandidature($candidat1);
        $reponse2->setIdQuestion($question2);
        $reponse2->setContenu("Je suis motivé et c'est tout");

        // Candidat 2
        $candidat2 = $this->privateContainer->get('doctrine')->getRepository('MentoratBundle:Candidat')
                                    ->findOneBy(array('nom' => 'Lolita'));

        $reponse3 = new RecrutementReponse();
        $reponse3->setIdCandidature($candidat2);
        $reponse3->setIdQuestion($question1);
        $reponse3->setContenu("C++;C--");

        $reponse4 = new RecrutementReponse();
        $reponse4->setIdCandidature($candidat2);
        $reponse4->setIdQuestion($question2);
        $reponse4->setContenu("Je suis !");

        $manager->persist($reponse1);
        $manager->persist($reponse2);
        $manager->persist($reponse3);
        $manager->persist($reponse4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 21;
    }
}
