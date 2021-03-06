<?php

namespace MentoratBundle\Repository;

/**
 * SoutenanceRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SoutenanceRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $mentor
     *
     * @return mixed
     */
    public function countSoutenancesDone($mentor)
    {
        return $this->createQueryBuilder('s')
            ->select('COUNT(s)')
            ->where('s.mentor = :mentor')
            ->setParameter('mentor', $mentor)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
