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
use MentoratBundle\Entity\Suivi;
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

        $parcours = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Parcours')
                                           ->findOneBy(array('libelle' => 'Chef de projet Multimédia - Développement'));

        $parcoursC = $this->privateContainer->get('doctrine')->getManager()->getRepository('BackendBundle:Parcours')
                                           ->findOneBy(array('libelle' => 'Développeur PHP/Symfony'));

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

        $mentore = $userManager->createUser();
        $suivi = new Suivi();

        $mentore->setUsername('Aurore');
        $mentore->setFirstname('Aurore');
        $mentore->setLastname('Gaucher');
        $mentore->setEmail('aurore.gaucher@gmail.com');
        $mentore->setCountry($country);
        $mentore->setPhone('00.00.00.00.00');
        $mentore->setPlainPassword('aurore');
        $mentore->setResume('Something');
        $mentore->setSuivi($suivi);
        $mentore->setArchived(false);
        $mentore->setRoles(array('ROLE_MENTORE'));
        $suivi->addUser($mentor);
        $suivi->addUser($mentore);
        $suivi->setParcours($parcours);
        $suivi->setFinancement(true);
        $suivi->setFinanceur('Pole-Emploi');
        $suivi->setDureeFinancement('16 mois');
        $suivi->setSuiviState('En cours');
        $suivi->setMentoreStatus('En formation');
        $suivi->setDateStart(new \DateTime());

        $mentoreC = $userManager->createUser();
        $suiviC = new Suivi();

        $mentoreC->setUsername('toto');
        $mentoreC->setFirstname('Toto');
        $mentoreC->setLastname('Toto');
        $mentoreC->setEmail('tyoto.toto@gmail.com');
        $mentoreC->setCountry($country);
        $mentoreC->setPhone('00.00.00.00.00');
        $mentoreC->setPlainPassword('toto');
        $mentoreC->setResume('Something');
        $mentoreC->setSuivi($suiviC);
        $mentoreC->setArchived(false);
        $mentoreC->setRoles(array('ROLE_MENTORE'));
        $suiviC->addUser($mentor);
        $suiviC->addUser($mentore);
        $suiviC->setParcours($parcoursC);
        $suiviC->setSuiviState('En cours');
        $suiviC->setMentoreStatus('En attente');
        $suiviC->setDateStart(new \DateTime());

        // Update the user
        $userManager->updateUser($userAdmin, true);
        $userManager->updateUser($mentor, true);
        $userManager->updateUser($supervisteurMentor, true);
        $userManager->updateUser($mentore, true);
        $userManager->updateUser($mentoreC, true);
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}
