<?php

namespace AdminBundle\Services;

use Doctrine\ORM\EntityManager;
use UserBundle\Entity\User;

class UserAdmin
{
    /**
     * @var EntityManager
     */
    private $doctrine;

    /**
     * Admin constructor.
     *
     * @param EntityManager $doctrine
     */
    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Allow the Admin to get all the users.
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getUsers()
    {
        return $this->doctrine->getRepository('UserBundle:User')->findAll();
    }
}
