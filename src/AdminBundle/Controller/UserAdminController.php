<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/users")
 */
class UserAdminController extends Controller
{
    /**
     * @Route("/list", name="gestion_users_admin")
     * @Template("AdminBundle/Action/list_users.html.twig")
     */
    public function indexAction(Request $request)
    {
        $users = $this->get('core.user')->getMentors();
        $mentores = $this->get('core.user')->getMentores();
        $mentor = $this->get('core.user')->addMentor($request);
        $mentore = $this->get('core.user')->addMentore($request);

        return array(
            'controller' => 'users_admin',
            'users' => $users,
            'mentores' => $mentores,
            'mentor' => $mentor->createView(),
            'mentore' => $mentore->createView(),
        );
    }

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

        if ($user->isValid()) {
            return $this->redirectToRoute('gestion_habilitations');
        }

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

        if ($mentore->isValid()) {
            return $this->redirectToRoute('gestion_habilitations');
        }

        return array('controller' => 'gestion_roles', 'mentore' => $mentore->createView());
    }
}
