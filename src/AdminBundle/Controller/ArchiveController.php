<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ArchiveController extends Controller
{
    /**
     * @Route("/archives", name="home_archives")
     * @Template("AdminBundle/Index/archives.html.twig")
     * @Method({"GET"})
     *
     * @return array
     */
    public function indexAction()
    {
        $mentor = $this->get('core.archive')->getMentorArchived();
        $mentores = $this->get('core.archive')->getMentoresArchived();
        $path = $this->get('core.archive')->getParcoursArchived();

        return array('controller' => 'archives', 'mentor' => $mentor,
                     'path' => $path, 'mentores' => $mentores, );
    }

    /**
     * @Route("/archived/out/mentor/{id}", name="out_archive_mentor")
     *
     * @param $id
     * @Method({"GET","PUT"})
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function outArchiveMentorAction($id)
    {
        $this->get('core.archive')->outArchiveMentor($id);

        return $this->redirectToRoute('home_backend');
    }

    /**
     * @Route("/archived/out/mentore/{id}", name="out_archive_mentore")
     * @Method({"GET","PUT"})
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function outArchiveMentoreAction($id)
    {
        $this->get('core.archive')->outArchiveMentore($id);

        return $this->redirectToRoute('home_backend');
    }

    /**
     * @Route("/archived/out/path/{id}", name="out_archive_path")
     * @Method({"GET","PUT"})
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function outArchivePathAction($id)
    {
        $this->get('core.archive')->outArchiveParcours($id);

        return $this->redirectToRoute('home_admin');
    }
}
