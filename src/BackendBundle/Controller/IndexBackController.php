<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class IndexBackController extends Controller
{
    /**
     * @Route("/", name="home_backend")
     * @Template("BackBundle/Index/index.html.twig")
     */
    public function indexAction()
    {
        $mentors = $this->get('core.admin')->getMentors();
        $mentores = $this->get('core.admin')->getMentores();
        $soutenances = $this->get('core.back')->getSoutenances();
        $parcours = $this->get('core.back')->getParcours();
        $notes = $this->get('core.admin')->getNotesSuivi();

        return array('mentors' => $mentors, 'mentores' => $mentores,
                     'soutenances' => $soutenances, 'parcours' => $parcours,
                     'notes' => $notes, );
    }

    /**
     * @Route("/show/{id}/details", name="show_details_mentore")
     * @Template("BackBundle/Action/Details/show_mentores.html.twig")
     */
    public function detailsMentoreAction(Request $request, $id)
    {
        $mentores = $this->get('core.mentore')->viewMentore($id);
        $note = $this->get('core.admin')->addNote($request, $id);
        $notes = $this->get('core.mentore')->getNotesByStudent($id);

        return array('mentores' => $mentores, 'note' => $note->createView(),
                     'notes' => $notes, );
    }
}
