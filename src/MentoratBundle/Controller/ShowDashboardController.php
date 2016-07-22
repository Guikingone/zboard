<?php

namespace MentoratBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShowDashboardController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     *
     * @return array
     * @Route("/show/{id}/details", name="show_details_mentore")
     * @Template("BackBundle/Action/Details/show_mentores.html.twig")
     */
    public function showProfilMentoreAction(Request $request, $id)
    {
        $mentores = $this->get('core.mentore')->viewMentore($id);
        $note = $this->get('core.admin')->addNote($request, $id);
        $notes = $this->get('core.mentore')->getNotesByStudent($id);

        return array('mentores' => $mentores, 'note' => $note->createView(),
            'notes' => $notes, );
    }
}
