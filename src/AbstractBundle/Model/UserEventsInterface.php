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

interface UserEventsInterface
{
    /**
     * @return mixed
     */
    public function getFirstname();

    /**
     * @return mixed
     */
    public function getLastname();

    /**
     * @return mixed
     */
    public function getAddress();

    /**
     * @return mixed
     */
    public function getZipcode();

    /**
     * @return mixed
     */
    public function getCity();

    /**
     * @return mixed
     */
    public function getPhone();

    /**
     * @return mixed
     */
    public function getResume();

    /**
     * @return mixed
     */
    public function getAvailable();
}
