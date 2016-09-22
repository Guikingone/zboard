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
 * Interface UserInterface.
 */
interface UserInterface
{
    /**
     * @return mixed
     */
    public function getId();

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
    public function getCountry();

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
    public function getProfileImage();

    /**
     * @return mixed
     */
    public function getAvailable();

    /**
     * @return mixed
     */
    public function getSuivi();

    /**
     * @return mixed
     */
    public function getNotes();

    /**
     * @return mixed
     */
    public function getSessions();

    /**
     * @return mixed
     */
    public function getSoutenances();

    /**
     * @return mixed
     */
    public function getCompetences();

    /**
     * @return mixed
     */
    public function getUserGroups();

    /**
     * @return mixed
     */
    public function getArchived();

    /**
     * @return mixed
     */
    public function getEvents();

    /**
     * @return mixed
     */
    public function getActivity();

    /**
     * @return mixed
     */
    public function getFactures();

    /**
     * @param $firstname
     *
     * @return mixed
     */
    public function setFirstname($firstname);

    /**
     * @param $lastname
     *
     * @return mixed
     */
    public function setLastname($lastname);

    /**
     * @param $address
     *
     * @return mixed
     */
    public function setAddress($address);
}
