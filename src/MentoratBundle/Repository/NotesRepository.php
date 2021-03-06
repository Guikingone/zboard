<?php

namespace MentoratBundle\Repository;

/**
 * NotesRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NotesRepository extends \Doctrine\ORM\EntityRepository
{
    public function getNotesByStudent($id)
    {
        return $this->createQueryBuilder('n')
                    ->where('n.suivi = :id')
                        ->setParameter('id', $id)
                    ->orderBy('n.dateCreated', 'DESC')
                    ->getQuery()
                    ->getResult();
    }
}
