<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AbstractBundle\Model;

interface EventsInterface
{
    /**
     * @return mixed
     */
    public function getLibelle();

    /**
     * @return mixed
     */
    public function getDate();

    /**
     * @return mixed
     */
    public function getCategorie();
}
