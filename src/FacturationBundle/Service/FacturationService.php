<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacturationBundle\Service;

use Doctrine\ORM\EntityManager;
use FacturationBundle\Entity\Facture;
use NotificationBundle\Services\Evenements;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Session\Session;

class FacturationService
{
    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var Evenements
     */
    private $events;

    /**
     * FacturationService constructor.
     *
     * @param EntityManager $doctrine
     */
    public function __construct(EntityManager $doctrine, Session $session, Evenements $events)
    {
        $this->doctrine = $doctrine;
        $this->session = $session;
        $this->events = $events;
    }

    /**
     * Allow to generate a new facture linked to a teacher.
     *
     * @param $id
     */
    public function generateMentorFacture($id)
    {
        try {
            $user = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));

            $sessions = $this->doctrine->getRepository('MentoratBundle:Sessions')->findBy(array('mentor' => $id));

            $facture = new Facture();
            $facture->setLibelle('Facture du mentor '.$user->getFirstname().' '.$user->getLastname());
            $facture->setState('En facturation');
            $facture->setNbrSessions(count($sessions));
            $facture->setDateCreation(new \DateTime());
            $facture->setDateValiditee($facture->getDateCreation()->add(new \DateInterval('P8D')));
            $facture->setDateFacturation($facture->getDateCreation()->add(new\DateInterval('P8D')));
            $facture->setUser($user);
            $user->addFacture($facture);

            $this->doctrine->persist($facture);
            $this->doctrine->flush();

            $this->session->getFlashBag()->add('success', 'Votre facture a bien été générée.');
            $this->events->createUserEvents($user, 'Génération de votre facture mensuelle', 'Information');
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Allow to generate the factures linked to all the teachers.
     */
    public function generateFactures()
    {
        $mentor = $this->doctrine->getRepository('UserBundle:User')->findAll();

        $sessionFacturables = [];

        foreach ($mentor as $user) {
            $sessions = $this->doctrine->getRepository('MentoratBundle:Sessions')->getSessionsbyMentor($user);

            foreach ($sessions as $session) {
                switch ($session) {
                    case $session->getStatus() === 'Présent':
                        $sessionFacturables[$session];
                        break;
                    case $session->getStatus() === 'Absent':
                        $sessionFacturables[$session];
                        break;
                    case $session->getStatus() === 'No Show':
                        $sessionFacturables[$session];
                        break;
                    default:
                        throw new Exception('Aucune session n\'a été trouvée.');
                }
            }

            $facture = new Facture();

            $facture->setDateCreation(new \DateTime());
            $facture->setDateValiditee($facture->getDateCreation()->add(new \DateInterval('P8D')));
            $facture->setState('En facturation');
            $facture->setUser($user);
            $user->addFacture($facture);

            $this->doctrine->persist($facture);
            $this->doctrine->flush();

            $this->events->createUserEvents($user, 'Facturation effectuée, vous recevrez une copie par email.', 'Important');
        }
    }
}
