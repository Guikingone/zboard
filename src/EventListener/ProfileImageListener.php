<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EventListener;

use AdminBundle\Services\Uploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use UserBundle\Entity\Mentore;
use UserBundle\Entity\User;

class ProfileImageListener
{
    /**
     * @var Uploader
     */
    private $uploader;

    /**
     * The path of the profile image.
     */
    private $targetPath;

    /**
     * ProfileImageListener constructor.
     *
     * @param Uploader $uploader
     */
    public function __construct(Uploader $uploader, $targetPath)
    {
        $this->uploader = $uploader;
        $this->targetPath = $targetPath;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof User || !$entity instanceof Mentore) {
            return;
        }

        $this->uploadFile($entity);
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof User || !$entity instanceof Mentore) {
            return;
        }

        $this->uploadFile($entity);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof User || !$entity instanceof Mentore) {
            return;
        }

        $filename = $entity->getProfileImage();

        $entity->setProfileImage(new File($this->targetPath.'/'.$filename));
    }

    /**
     * Allow to call the Uploader Service and upload files.
     *
     * @param $entity   | The entity who's gonna be linked to a image.
     */
    private function uploadFile($entity)
    {
        if (!$entity instanceof User || !$entity instanceof Mentore) {
            return;
        }

        $file = $entity->getProfileImage();

        if (!$file instanceof Uploader) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setProfileImage($fileName);
    }
}
