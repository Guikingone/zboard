<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EventListenerBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use UserBundle\Entity\Mentore;

class StudentNotificationEvent extends Event
{
    /**
     * @var Mentore
     */
    protected $mentore;

    /**
     * @var string
     */
    protected $contenu;

    /**
     * @var string
     */
    protected $categorie;

    /**
     * StudentNotificationEvent constructor.
     *
     * @param Mentore $mentore   | The student who receive the notification.
     * @param         $contenu   | The content of the notification.
     * @param         $categorie | The categorie of the notification.
     */
    public function __construct(Mentore $mentore, $contenu, $categorie)
    {
        $this->mentore = $mentore;
        $this->contenu = $contenu;
        $this->categorie = $categorie;
    }

    /**
     * @return Mentore
     */
    public function getMentore()
    {
        return $this->mentore;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }
}
