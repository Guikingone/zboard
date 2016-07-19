<?php

namespace AdminBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Session\Session;

class Admin
{
    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * @var FormFactory
     */
    private $form;

    /**
     * @var Session
     */
    private $session;

    /**
     * Admin constructor.
     *
     * @param EntityManager $doctrine
     * @param FormFactory   $form
     * @param Session       $session
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->session = $session;
    }

    /**
     * Allow the back to get all the mentors.
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getMentors()
    {
        return $this->doctrine->getRepository('UserBundle:User')->findAll();
    }

    /**
     * Allow the back to get all the mentores.
     *
     * @return array|\MentoratBundle\Entity\Mentore[]
     */
    public function getMentores()
    {
        return $this->doctrine->getRepository('MentoratBundle:Mentore')->findAll();
    }

    /**
     * Allow the back to get all the new mentores since actual datetime.
     *
     * @return array
     */
    public function getNewMentores()
    {
        $days = new \DateTime();

        return $this->doctrine->getRepository('MentoratBundle:Mentore')->getNewMentores($days);
    }

    /**
     * Allow the back to get all the paths.
     *
     * @return array|\BackendBundle\Entity\Parcours[]
     */
    public function getParcours()
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->findAll();
    }

    /**
     * Allow th back to get access to the project linked to a path.
     *
     * @param $id
     *
     * @return array
     */
    public function getProjet($id)
    {
        return $this->doctrine->getRepository('BackendBundle:Projet')->getProjetByParcours($id);
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

}
