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

class FacturationService
{
    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * @var Evenements
     */
    private $events;

    /**
     * FacturationService constructor.
     *
     * @param EntityManager $doctrine
     */
    public function __construct(EntityManager $doctrine, Evenements $events)
    {
        $this->doctrine = $doctrine;
        $this->events = $events;
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
                        array_push($sessionFacturables, $session);
                        break;
                    case $session->getStatus() === 'Absent':
                        array_push($sessionFacturables, $session);
                        break;
                    case $session->getStatus() === 'No Show':
                        array_push($sessionFacturables, $session);
                        break;
                    default:
                        throw new Exception('Aucune session n\'a été trouvée.');
                }
            }

            $facture = new Facture();

            $facture->setDateCreation(new \DateTime());
            $facture->setDateValiditee($facture->getDateCreation()->add(new \DateInterval('P8D')));
            $facture->setState('En facturationj');
            $facture->setUser($user);
            $user->addFacture($facture);

            $this->events->createUserEvents($user, 'Facturation effectuée, vous recevrez une copie par email.', 'Important');
        }
    }
}
