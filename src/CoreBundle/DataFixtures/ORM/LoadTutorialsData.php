<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use MentoratBundle\Entity\Tutorial;
use MentoratBundle\Entity\TutorialCategory;

class LoadTutorialsData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        $category = new TutorialCategory();
        $category->setName("Le Mentorat");
        $category_2 = new TutorialCategory();
        $category_2->setName("CDPM - Marketing");

        $tutoriel = new Tutorial();
        $tutoriel->setTitle('Cours devenez mentor');
        $tutoriel->setLink('https://openclassrooms.com/courses/devenez-mentor-sur-openclassrooms/');
        $tutoriel->setCategory($category);

        $tutoriel_2 = new Tutorial();
        $tutoriel_2->setTitle('Bien réussir une soutenance');
        $tutoriel_2->setLink('https://openclassrooms.com/courses/devenez-mentor-sur-openclassrooms/');
        $tutoriel_2->setCategory($category);

        $tutoriel_3 = new Tutorial();
        $tutoriel_3->setTitle('Suivre son élève sur le projet 2');
        $tutoriel_3->setLink('https://openclassrooms.com/courses/devenez-mentor-sur-openclassrooms/');
        $tutoriel_3->setCategory($category_2);

        $manager->persist($category);
        $manager->persist($category_2);
        $manager->persist($tutoriel);
        $manager->persist($tutoriel_2);
        $manager->persist($tutoriel_3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 25;
    }
}
