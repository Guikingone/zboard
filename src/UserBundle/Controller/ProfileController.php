<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends BaseController
{
    /**
     * @Route("/dashboard/profile", name="mon_profil")
     * @Template("UserBundle/Profile/show.html.twig")
     *
     * return array
     */
    public function showAction()
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $nbSoutenances = $this->get('core.soutenance')->countSoutenancesDone($user);
        $nbMentores = $this->get('core.suivi')->countMentoreByMentor($user);

        return array(
            'user' => $user,
            'controller' => 'user',
            'title_action' => 'Mon profil',
            'nbSoutenances' => $nbSoutenances,
            'nbMentores' => $nbMentores,
        );
    }

    /**
     * @Route("/dashboard/profile/edit", name="mon_profil_edit")
     * @Template("UserBundle/Profile/edit.html.twig")
     *
     * @return array
     */
    public function editAction(Request $request)
    {
        $user = $this->get('core.user')->updateUserProfile($request, $this->getUser());

        return array(
            'user' => $user->createView(),
            'controller' => 'user',
            'title_action' => 'Modifier mon profil',
        );
    }
}
