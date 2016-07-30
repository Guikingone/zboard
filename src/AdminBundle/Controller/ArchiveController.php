<?php

namespace AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ArchiveController extends Controller
{
    /**
     * @Route("/archives", name="home_archives")
     * @Template("AdminBundle/Index/archives.html.twig")
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
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/archived/out/mentor/{id}", name="out_archive_mentor")
     */
    public function outArchiveMentor($id)
    {
        $this->get('core.archive')->outArchiveMentor($id);

        return $this->redirectToRoute('home_backend');
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/archived/out/mentore/{id}", name="out_archive_mentore")
     */
    public function outArchiveMentore($id)
    {
        $this->get('core.archive')->outArchiveMentore($id);

        return $this->redirectToRoute('home_backend');
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/archived/out/path/{id}", name="out_archive_path")
     */
    public function outArchivePath($id)
    {
        $this->get('core.archive')->outArchiveParcours($id);

        return $this->redirectToRoute('home_admin');
    }
}
