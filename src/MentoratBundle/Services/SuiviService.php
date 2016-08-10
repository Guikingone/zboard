<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;

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
