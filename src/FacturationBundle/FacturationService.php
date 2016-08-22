<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacturationBundle;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;

class FacturationService
{
    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * FacturationService constructor.
     *
     * @param EntityManager $doctrine
     */
    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function generateFactures()
    {
        $mentor = $this->doctrine->getRepository('UserBundle:User')->findAll();

        foreach ($mentor as $user) {
            $sessions = $this->doctrine->getRepository('MentoratBundle:Sessions')->getSessionsbyMentor($user);
            $sessionFacturables = [];

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
        }
    }
}
