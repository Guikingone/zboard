<?php

/*
 * This file is part of the Zboard project.
 *
 * (c) Guillaume Loulier <guillaume.loulier@hotmail.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AbstractBundle\Interfaces;

/**
 * Interface CountryInterface.
 */
interface CountryInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getLibelle();

    /**
     * @param $libelle
     *
     * @return mixed
     */
    public function setLibelle($libelle);
}
