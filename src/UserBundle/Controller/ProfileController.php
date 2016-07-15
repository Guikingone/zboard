<?php

namespace UserBundle\Controller;


use FOS\UserBundle\Controller\ProfileController as BaseController;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProfileController extends BaseController{

    /**
     * Show the user
     * @Route("/profile", name="show_profile")
     * @Template("UserBundle/Profile/show.html.twig")
     */
    public function showAction()
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return array(
            'user'          => $user,
            'controller'    => 'user'
        );
    }
}
