<?php

namespace MentoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/mes-mentores")
 */
class MentoreController extends Controller
{
    /**
     * @Route("/en-cours",name="en_cours")
     * @Template("MentoratBundle/Mentore/en-cours.html.twig")
     */
    public function enCoursAction()
    {
        $mentores = $this->get('core.mentore')->getMentores($this->getUser());

        return array(
            'controller' => 'mentorat',
            'mentores' => $mentores,
        );
    }

    /**
     * @Route("/en-attente",name="en_attente")
     * @Template("MentoratBundle/Mentore/en-attente.html.twig")
     */
    public function enAttenteAction()
    {
        $mentores = $this->get('core.mentore')->getMyWaitingMentore($this->getUser());

        return array(
            'controller' => 'mentorat',
            'mentores' => $mentores,
        );
    }

    /**
     * @Route("/mentorat-termine",name="mentorat_termine")
     * @Template("MentoratBundle/Mentore/mentorat-termine.html.twig")
     */
    public function mentoratFinishedAction()
    {
        $mentores = $this->get('core.mentore')->getMentoratFinished($this->getUser());

        return array(
            'controller' => 'mentorat',
            'mentores' => $mentores,
        );
    }
}
