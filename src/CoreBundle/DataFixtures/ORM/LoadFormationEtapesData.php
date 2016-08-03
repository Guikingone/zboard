<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use MentoratBundle\Entity\FormationEtape;

class LoadFormationEtapesData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $etape1 = new FormationEtape();
        $etape1->setEtape("J'ai accès aux channels slack");
        $etape1->setRequiresInput(false);

        $etape2 = new FormationEtape();
        $etape2->setEtape("J'ai listé mes compétences dans l'onglet profil");
        $etape2->setRequiresInput(false);

        $etape3 = new FormationEtape();
        $etape3->setEtape("J'ai signé mon contrat avec BenJ");
        $etape3->setRequiresInput(false);

        $etape4 = new FormationEtape();
        $etape4->setEtape("J'ai ma jolie certif du cours Devenez mentor sur OC et je met le lien ici :");
        $etape4->setRequiresInput(true);

        $etape5 = new FormationEtape();
        $etape5->setEtape("J'ai enregistré ma première session et je met le lien ici :");
        $etape5->setRequiresInput(true);

        $etape6 = new FormationEtape();
        $etape6->setEtape("J'ai ajouté une photo de profil sur slack et sur Zboard");
        $etape6->setRequiresInput(false);


        $manager->persist($etape1);
        $manager->persist($etape2);
        $manager->persist($etape3);
        $manager->persist($etape4);
        $manager->persist($etape5);
        $manager->persist($etape6);


        $manager->flush();
    }

    public function getOrder()
    {
        return 15;
    }
}
