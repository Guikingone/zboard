<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminBundle\Services;

use Doctrine\ORM\EntityManager;

class Statistiques
{
    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * Statistiques constructor.
     *
     * @param EntityManager $doctrine
     */
    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Allow the back to get all the paths made for the PPlus students.
     *
     * @return array|\BackendBundle\Entity\Parcours[]
     */
    public function getParcoursPlus()
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->getParcoursPlus();
    }

    /**
     * Allow the back to get all the paths made for the PClass students.
     *
     * @return array|\BackendBundle\Entity\Parcours[]
     */
    public function getParcoursClass()
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->getParcoursClass();
    }

    /**
     * Allow to get all the projects.
     *
     * @return array|\BackendBundle\Entity\Projet[]
     */
    public function getProjets()
    {
        return $this->doctrine->getRepository('BackendBundle:Projet')->findAll();
    }

    /**
     * Allow to get all the project finished.
     *
     * @return array
     */
    public function getProjetsFinished()
    {
        return $this->doctrine->getRepository('BackendBundle:Projet')->getProjetTermine();
    }

    /**
     * Allow the back to get all the soutenances.
     *
     * @return array|\MentoratBundle\Entity\Soutenance[]
     */
    public function getSoutenances()
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->findAll();
    }

    /**
     * Allow to get all the notes.
     *
     * @return array|\MentoratBundle\Entity\Notes[]
     */
    public function getNotesSuivi()
    {
        return $this->doctrine->getRepository('MentoratBundle:Notes')->findAll();
    }

    /**
     * Allow to get all the sessions cancelled.
     *
     * @return array
     */
    public function getSessionsCancelled()
    {
        return $this->doctrine->getRepository('MentoratBundle:Sessions')->getSessionsCancelled();
    }
}
