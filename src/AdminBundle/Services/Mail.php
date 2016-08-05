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

class Mail
{
    /**
     * Allow to create a new Message.
     *
     * @param $objet
     * @param $destinataire
     * @param $body
     *
     * @return \Swift_Mime_MimePart
     */
    public function buildMessage($objet, $expediteur, $destinataire, $body)
    {
        return \Swift_Message::newInstance()
                    ->setSubject($objet)
                    ->setFrom($expediteur)
                    ->setTo($destinataire)
                    ->setBody($body);
    }
}
