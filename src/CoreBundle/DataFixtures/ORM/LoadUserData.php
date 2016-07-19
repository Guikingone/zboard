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
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    private $privateContainer;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->privateContainer = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Get our userManager, you must implement `ContainerAwareInterface`
        $userManager = $this->privateContainer->get('fos_user.user_manager');

        // Création de notre utilisateur ADMIN
        $userAdmin = $userManager->createUser();
        $userAdmin->setUsername('admin');
        $userAdmin->setFirstname('John');
        $userAdmin->setLastname('Doe');
        $userAdmin->setEmail('contact@zboard.fr');
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setAddress('3 rue LABAS');
        $userAdmin->setZipCode('44300');
        $userAdmin->setCity('nantes');
        $userAdmin->setCountry("FR");
        $userAdmin->setEnabled(true);
        $userAdmin->setPhone('06.06.06.06.06');
        $userAdmin->setRoles(array('ROLE_ADMIN'));
        $userAdmin->setAvailable(true);

        // Création de notre utilisateur MENTOR
        $mentor = $userManager->createUser();
        $mentor->setUsername('mentor');
        $mentor->setFirstname('Jacky');
        $mentor->setLastname('Chan');
        $mentor->setEmail('mentor@zboard.fr');
        $mentor->setPlainPassword('mentor');
        $mentor->setAddress('3 rue LABAS');
        $mentor->setZipCode('44390');
        $mentor->setCity('nantes');
        $mentor->setCountry("FR");
        $mentor->setEnabled(true);
        $mentor->setPhone('02.22.01.05.06');
        $mentor->setRoles(array('ROLE_MENTOR'));
        $mentor->setAvailable(true);

        // Création de notre utilisateur SUPERVISEUR MENTOR
        $supervisteurMentor = $userManager->createUser();
        $supervisteurMentor->setUsername('severine');
        $supervisteurMentor->setFirstname('Severine');
        $supervisteurMentor->setLastname('Chan');
        $supervisteurMentor->setEmail('smentor@zboard.fr');
        $supervisteurMentor->setPlainPassword('severine');
        $supervisteurMentor->setAddress('4 rue LABAS');
        $supervisteurMentor->setZipCode('44290');
        $supervisteurMentor->setCity('nantes');
        $supervisteurMentor->setCountry("FR");
        $supervisteurMentor->setEnabled(true);
        $supervisteurMentor->setPhone('02.22.29.05.06');
        $supervisteurMentor->setRoles(array('ROLE_SUPERVISEUR_MENTOR'));
        $supervisteurMentor->setAvailable(true);

        // Update the user
        $userManager->updateUser($userAdmin, true);
        $userManager->updateUser($mentor, true);
        $userManager->updateUser($supervisteurMentor, true);
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}
