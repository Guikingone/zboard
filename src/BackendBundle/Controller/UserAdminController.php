<?php

namespace BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserAdminController extends Controller
{
    /**
     * @Route("/update/roles/users/{id}", name="update_roles_users")
     * @Template("AdminBundle/Action/Update/roles_users.html.twig")
     *
     * @param Request $request
     * @param $id
     *
     * @return array
     */
    public function updateUserAction(Request $request, $id)
    {
        $user = $this->get('core.user')->addRoleToUser($request, $id);

        return array('controller' => 'gestion_roles', 'user' => $user->createView());
    }

    /**
     * @Route("/update/roles/mentore/{id}", name="update_roles_mentore")
     * @Template("AdminBundle/Action/Update/roles_mentores.html.twig")
     *
     * @param Request $request
     * @param $id
     *
     * @return array
     */
    public function updateMentoreAction(Request $request, $id)
    {
        $mentore = $this->get('core.user')->addRoleToMentore($request, $id);

        return array('controller' => 'gestion_roles', 'mentore' => $mentore->createView());
    }
}
