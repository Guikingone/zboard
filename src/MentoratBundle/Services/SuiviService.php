<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class SuiviService
{
    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * @param EntityManager $doctrine
     */
    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Return the number of mentoré owned by the mentor in parameter.
     *
     * @param $mentor
     *
     * @return mixed
     */
    public function countMentoreByMentor($mentor)
    {
        return $this->doctrine->getRepository('MentoratBundle:Suivi')->countMentoreByMentorDisplayed($mentor);
    }
}
