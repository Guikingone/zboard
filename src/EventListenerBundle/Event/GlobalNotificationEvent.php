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

class GlobalNotificationEvent extends Event
{
    /**
     * @var string
     */
    protected $libelle;

    /**
     * @var string
     */
    protected $categorie;

    /**
     * GlobalNotificationEvent constructor.
     *
     * @param $libelle
     * @param $categorie
     */
    public function __construct($libelle, $categorie)
    {
        $this->libelle = $libelle;
        $this->categorie = $categorie;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
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
