<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AdminBundle\Services;

use Doctrine\ORM\EntityManager;
use EventListenerBundle\Event\GlobalNotificationEvent;
use EventListenerBundle\Event\StudentNotificationEvent;
use EventListenerBundle\Event\UserNotificationEvent;
use EventListenerBundle\Event\ZboardEvents;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;

class Archive
{
    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var TraceableEventDispatcher
     */
    private $evet;

    /**
     * Archive constructor.
     *
     * @param EntityManager $doctrine
     * @param Session       $session
     */
    public function __construct(EntityManager $doctrine, Session $session, TraceableEventDispatcher $evet)
    {
        $this->doctrine = $doctrine;
        $this->session = $session;
        $this->evet = $evet;
    }

    /**
     * Allow to get all the mentors archived.
     *
     * @return array|\UserBundle\Entity\User[]
     */
    public function getMentorArchived()
    {
        return $this->doctrine->getRepository('UserBundle:User')->findBy(array('archived' => true));
    }

    /**
     * Allow to get all the students archived.
     *
     * @return array|\UserBundle\Entity\Mentore[]
     */
    public function getMentoresArchived()
    {
        return $this->doctrine->getRepository('UserBundle:Mentore')->findBy(array('archived' => true));
    }

    /**
     * Allow to get all the path archived.
     *
     * @return array|\BackendBundle\Entity\Parcours[]
     */
    public function getParcoursArchived()
    {
        return $this->doctrine->getRepository('BackendBundle:Parcours')->findBy(array('archived' => true));
    }

    /**
     * Allow to archive the teacher using is $id, during this operation, the teacher lose access to his profil and
     * the back doesn't see him in the list of teacher.
     *
     * @param $id
     */
    public function archiveMentor($id)
    {
        $mentor = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));

        if (null === $mentor) {
            throw new Exception('Le mentor ne semble pas exister ou être déjà archivé.');
        }

        $mentor->setArchived(true);
        $mentor->setAvailable(false);
        $mentor->setEnabled(false);

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le mentor a bien été archivé.');

        $event = new UserNotificationEvent($mentor, 'Votre compte a été archivé et vos accès coupés.', 'Important');
        $this->evet->dispatch(ZboardEvents::USER_NOTIFICATION, $event);
    }

    /**
     * Allow to archived the student using is $id, during this operation, the student lose access to his profil and
     * the back doesn't see him in the list of student.
     *
     * @param $id
     */
    public function archiveMentore($id)
    {
        $mentore = $this->doctrine->getRepository('UserBundle:Mentore')->findOneBy(array('id' => $id));

        if (null === $mentore) {
            throw new Exception('Le mentore ne semble pas exister ou être déjà archivé.');
        }

        $mentore->setArchived(true);
        $mentore->setAvailable(false);
        $mentore->setEnabled(false);

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le mentore a bien été archivé.');

        $event = new StudentNotificationEvent($mentore, 'Votre compte a été archivé et vos accès coupés.', 'Important');
        $this->evet->dispatch(ZboardEvents::STUDENT_NOTIFICATION, $event);
    }

    /**
     * Allow to archive a path using is $id.
     *
     * @param $id
     */
    public function archiveParcours($id)
    {
        $parcours = $this->doctrine->getRepository('BackendBundle:Parcours')->findOneBy(array('id' => $id));

        if (null === $parcours) {
            throw new Exception('Le parcours ne semble pas exister ou a déjà été archiver.');
        }

        $parcours->setArchived(true);

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le parcours a bien été archivé.');

        $event = new GlobalNotificationEvent('Le parcours '.$parcours->getLibelle().' a été archivé.', 'Important');
        $this->evet->dispatch(ZboardEvents::GLOBAL_NOTIFICATION, $event);
    }

    /**
     * Allow to archive a courses using id $id.
     *
     * @param $id
     */
    public function archiveCourses($id)
    {
        $courses = $this->doctrine->getRepository('BackendBundle:Cours')->findOneBy(array('id' => $id));

        if (null === $courses) {
            throw new Exception('Le cours ne semble pas exister ou a déjà été archivé.');
        }

        $courses->setArchived(true);

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le cours a bien été archivé.');

        $event = new GlobalNotificationEvent('Le cours '.$courses->getLibelle().' du parcours '.$courses->getParcours()->getLibelle().' a été archivé.', 'Important');
        $this->evet->dispatch(ZboardEvents::GLOBAL_NOTIFICATION, $event);
    }

    /**
     * Allow to archive a project using id $id.
     *
     * @param $id
     */
    public function archiveProject($id)
    {
        $projet = $this->doctrine->getRepository('BackendBundle:Projet')->findOneBy(array('id' => $id));

        if (null === $projet) {
            throw new Exception('Le projet ne semble pas exister ou a déjà été archivé.');
        }

        $projet->setArchived(true);

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le projet a bien été archivé.');

        $event = new GlobalNotificationEvent('Le projet '.$projet->getLibelle().' du parcours '.$projet->getParcours()->getLibelle().' a été archivé.', 'Important');
        $this->evet->dispatch(ZboardEvents::GLOBAL_NOTIFICATION, $event);
    }

    /**
     * Allow to get out of the archives the teacher using is $id.
     *
     * @param $id
     */
    public function outArchiveMentor($id)
    {
        $mentor = $this->doctrine->getRepository('UserBundle:User')->findOneBy(array('id' => $id));

        if (null === $mentor) {
            throw new Exception('Le mentor ne semble pas exister ou être déjà désarchivé.');
        }

        $mentor->setArchived(false);
        $mentor->setAvailable(true);

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le mentor a bien été sorti des archives.');

        $event = new UserNotificationEvent($mentor, 'Votre compte a été désarchivé et vos accès activés.', 'Important');
        $this->evet->dispatch(ZboardEvents::USER_NOTIFICATION, $event);
    }

    /**
     * Allow to get out of the archives the student using is $id.
     *
     * @param $id
     */
    public function outArchiveMentore($id)
    {
        $mentore = $this->doctrine->getRepository('UserBundle:Mentore')->findOneBy(array('id' => $id));

        if (null === $mentore) {
            throw new Exception('Le mentore ne semble pas exister ou a déjà été désarchivé.');
        }

        $mentore->setArchived(false);
        $mentore->setAvailable(true);

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le mentore a bien été sorti des archives.');

        $event = new StudentNotificationEvent($mentore, 'Votre compte a été désarchivé et vos accès activés', 'Important');
        $this->evet->dispatch(ZboardEvents::STUDENT_NOTIFICATION, $event);
    }

    /**
     * Allow to get out of the archives the path using is $id.
     *
     * @param $id
     */
    public function outArchiveParcours($id)
    {
        $parcours = $this->doctrine->getRepository('BackendBundle:Parcours')->findOneBy(array('id' => $id));

        $projets = $this->doctrine->getRepository('BackendBundle:Projet')
                                  ->findBy(array('parcours' => $id, 'archived' => true));

        $cours = $this->doctrine->getRepository('BackendBundle:Cours')
                                ->findBy(array('parcours' => $id, 'archived' => true));

        if (null === $parcours) {
            throw new Exception('Le parcours ne semble pas exister ou a déjà été désarchiver.');
        }

        $parcours->setArchived(false);

        foreach ($projets as $projet) {
            $projet->setArchived(false);
        }

        foreach ($cours as $courses) {
            $courses->setArchived(false);
        }

        $this->doctrine->flush();

        $this->session->getFlashBag()->add('success', 'Le parcours ainsi que les cours et projets liés ont bien été sorti des archives.');

        $event = new GlobalNotificationEvent('Le parcours '.$parcours->getLibelle().' ainsi que les cours et projets liés ont bien été désarchivé.', 'Important');
        $this->evet->dispatch(ZboardEvents::GLOBAL_NOTIFICATION, $event);
    }
}
