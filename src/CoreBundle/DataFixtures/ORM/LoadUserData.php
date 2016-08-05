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
use UserBundle\Entity\User;

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

        $country = $this->privateContainer->get('doctrine')->getManager()->getRepository('AdminBundle:Country')
                                           ->findOneBy(array('libelle' => 'France'));

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
        $userAdmin->setCountry($country);
        $userAdmin->setEnabled(true);
        $userAdmin->setArchived(false);
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
        $mentor->setCountry($country);
        $mentor->setEnabled(true);
        $mentor->setArchived(false);
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
        $supervisteurMentor->setCountry($country);
        $supervisteurMentor->setEnabled(true);
        $supervisteurMentor->setArchived(false);
        $supervisteurMentor->setPhone('02.22.29.05.06');
        $supervisteurMentor->setRoles(array('ROLE_SUPERVISEUR_MENTOR'));
        $supervisteurMentor->setAvailable(true);

        // Création de notre utilisateur MENTOR_DEBUTANT
        $mentorDebutant = $userManager->createUser();
        $mentorDebutant->setUsername('michael');
        $mentorDebutant->setFirstname('Michael');
        $mentorDebutant->setLastname('Jackson');
        $mentorDebutant->setEmail('michaeljackson@zboard.fr');
        $mentorDebutant->setPlainPassword('michael');
        $mentorDebutant->setAddress('5 rue LABAS');
        $mentorDebutant->setZipCode('44290');
        $mentorDebutant->setCity('Panam');
        $mentorDebutant->setCountry($country);
        $mentorDebutant->setEnabled(true);
        $mentorDebutant->setArchived(false);
        $mentorDebutant->setPhone('07.46.12.06.07');
        $mentorDebutant->setRoles(array('ROLE_MENTOR_DEBUTANT'));
        $mentorDebutant->setAvailable(true);

        // Update the user
        $userManager->updateUser($userAdmin, true);
        $userManager->updateUser($mentor, true);
        $userManager->updateUser($supervisteurMentor, true);
        $userManager->updateUser($mentorDebutant, true);
    }

    public function getOrder()
    {
        return 5;
    }
}
