<?php

namespace MentoratBundle\Repository;

/**
 * SessionsRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SessionsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getSessionsbyMentore($id)
    {
        return $this->createQueryBuilder('s')
                    ->where('s.mentore = :id')
                        ->setParameter('id', $id)
                    ->orderBy('s.dateSession', 'DESC')
                    ->getQuery()
                    ->getResult();
    }

    public function getSessionsbyMentor($id)
    {
        return $this->createQueryBuilder('s')
                    ->where('s.mentor = :id')
                        ->setParameter('id', $id)
                    ->orderBy('s.dateSession', 'DESC')
                    ->getQuery()
                    ->getResult();
    }

    public function getSessionsCancelled()
    {
        return $this->createQueryBuilder('s')
                    ->where('s.status = :status')
                        ->setParameter('status', $status = 'Annulee')
                    ->getQuery()
                    ->getResult();
    }
}
