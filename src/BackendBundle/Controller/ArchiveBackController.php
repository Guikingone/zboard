<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ArchiveBackController extends Controller
{
    /**
     * @param $id
     *
     * @return array
     *
     * @Route("/archived/mentor/{id}", name="archive_mentor")
     */
    public function archiveMentorAction($id)
    {
        $this->get('core.archive')->archiveMentor($id);

        return $this->redirectToRoute('home_backend');
    }

    /**
     * @param $id
     *
     * @return array
     *
     * @Route("/archived/mentore/{id}", name="archive_mentore")
     */
    public function archiveMentoreAction($id)
    {
        $this->get('core.archive')->archiveMentore($id);

        return $this->redirectToRoute('home_backend');
    }

    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/archived/path/{id}", name="archive_path")
     */
    public function archiveParcoursAction($id)
    {
        $this->get('core.archive')->archiveParcours($id);

        return $this->redirectToRoute('gestion_parcours');
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

        return $this->redirectToRoute('gestion_parcours');
    }
}
