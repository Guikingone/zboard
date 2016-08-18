<?php

namespace UserBundle\Repository;

/**
 * MentoreRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MentoreRepository extends \Doctrine\ORM\EntityRepository
{
    public function getMentoresWaiting()
    {
        return $this->createQueryBuilder('m')
                    ->innerJoin('m.suivi', 's')
                        ->addSelect('s')
                    ->where('s.mentore_status = :status')
                        ->setParameter('status', 'En attente')
                    ->getQuery()
                    ->getResult();
    }

    public function getMentoresPPlus()
    {
        return $this->createQueryBuilder('m')
                    ->innerJoin('m.suivi', 's')
                        ->addSelect('s')
                    ->innerJoin('s.parcours', 'p')
                        ->addSelect('p')
                    ->innerJoin('p.abonnement', 'a')
                    ->where('a.libelle = :abonnement')
                        ->setParameter('abonnement', 'Premium Plus')
                    ->getQuery()
                    ->getResult();
    }

    public function getMentoresPClass()
    {
        return $this->createQueryBuilder('m')
                    ->innerJoin('m.suivi', 's')
                        ->addSelect('s')
                    ->innerJoin('s.parcours', 'p')
                        ->addSelect('p')
                    ->innerJoin('p.abonnement', 'a')
                    ->where('a.libelle = :abonnement')
                        ->setParameter('abonnement', 'Premium Class')
                    ->getQuery()
                    ->getResult();
    }
}
