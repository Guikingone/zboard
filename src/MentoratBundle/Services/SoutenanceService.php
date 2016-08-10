<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;

class SoutenanceService
{
    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * @var FormFactory
     */
    protected $form;


    /**
     * SoutenanceService constructor.
     * @param EntityManager $doctrine
     * @param FormFactory $form
     */
    public function __construct(EntityManager $doctrine, FormFactory $form)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
    }

    /**
     * @param $user
     *
     * @return array|\MentoratBundle\Entity\Soutenance[]
     */
    public function getSoutenanceWaiting($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->findBy(array(
            'mentor' => $user,
            'status' => 'WAITING',
        ));
    }

    /**
     * @param $user
     *
     * @return array|\MentoratBundle\Entity\Soutenance[]
     */
    public function getSoutenanceDone($user)
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->findBy(array(
            'mentor' => $user,
            'status' => 'DONE',
        ));
    }

    /**
     * Return the number of soutenances done by the mentor in parameter.
     *
     * @param $mentor
     *
     * @return mixed
     */
    public function countSoutenancesDone($mentor)
    {
        return $this->doctrine->getRepository('MentoratBundle:Soutenance')->countSoutenancesDone($mentor);
    }
}
