<?php

namespace AdminBundle\Services;

use Doctrine\ORM\EntityManager;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

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
