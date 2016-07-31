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

class LoadMentoreData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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

        $mentore = $userManager->createUser();

        $mentore->setUsername('Aurore');
        $mentore->setFirstname('Aurore');
        $mentore->setLastname('Gaucher');
        $mentore->setEmail('aurore.gaucher@gmail.com');
        $mentore->setCountry($country);
        $mentore->setPhone('00.00.00.00.00');
        $mentore->setPlainPassword('aurore');
        $mentore->setResume('Something');
        $mentore->setArchived(false);
        $mentore->setRoles(array('ROLE_MENTORE'));

        $mentoreC = $userManager->createUser();

        $mentoreC->setUsername('toto');
        $mentoreC->setFirstname('Toto');
        $mentoreC->setLastname('Toto');
        $mentoreC->setEmail('tyoto.toto@gmail.com');
        $mentoreC->setCountry($country);
        $mentoreC->setPhone('00.00.00.00.00');
        $mentoreC->setPlainPassword('toto');
        $mentoreC->setResume('Something');
        $mentoreC->setArchived(false);
        $mentoreC->setRoles(array('ROLE_MENTORE'));

        // Update the user
        $userManager->updateUser($mentore, true);
        $userManager->updateUser($mentoreC, true);
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}
