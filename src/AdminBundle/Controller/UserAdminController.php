<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/users")
 */
class UserAdminController extends Controller
{
    /**
     * @Route("/list", name="gestion_users_admin")
     * @Template("AdminBundle/Action/list_users.html.twig")
     */
    public function indexAction()
    {
        $users = $this->get('core.user_admin')->getUsers();

        return array(
            'controller' => 'users_admin',
            'users' => $users,
        );
    }
}
