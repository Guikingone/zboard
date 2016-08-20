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
use UserBundle\Entity\User;

class NotificationEvent extends Event
{
    protected $user;

    protected $contenu;

    protected $categorie;

    /**
     * NotificationEvent constructor.
     *
     * @param User $user    | The user linked who receive the notification.
     * @param $contenu      | The content of the notification.
     * @param $categorie    | The categorie of the notification.
     */
    public function __construct(User $user, $contenu, $categorie)
    {
        $this->user = $user;
        $this->contenu = $contenu;
        $this->categorie = $categorie;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function getUser()
    {
        return $this->user;
    }
}
