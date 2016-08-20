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
    /**
     * @var string
     */
    private $categorie;

    /**
     * @var string
     */
    private $contenu;

    /**
     * @var User
     */
    private $user;

    /**
     * NotificationEvent constructor.
     *
     * @param $contenu
     * @param $categorie
     */
    public function __construct($contenu, $categorie, User $user)
    {
        $this->contenu = $contenu;
        $this->categorie = $categorie;
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }
}
