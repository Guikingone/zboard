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

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Swift_Mailer;

class Mail
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * Mail constructor.
     *
     * @param EngineInterface $templating
     * @param Swift_Mailer    $mailer
     */
    public function __construct(EngineInterface $templating, Swift_Mailer $mailer)
    {
        $this->templating = $templating;
        $this->mailer = $mailer;
    }

    /**
     * Allow to create a new Message.
     *
     * @param $objet        | The object of the message
     * @param $destinataire | The destinataire of the message
     * @param $body         | The body of the message
     *
     * @return \Swift_Mime_MimePart
     */
    public function buildMessage($objet, $destinataire, $body)
    {
        return \Swift_Message::newInstance()
                    ->setSubject($objet)
                    ->setFrom('no-reply@zboard.fr')
                    ->setTo($destinataire)
                    ->setBody($body);
    }

    /**
     * Allow to send the message $message.
     *
     * @param $message | The message to send.
     */
    public function sendMessage($message)
    {
        $this->mailer->send($message);
    }

    /**
     * Create a message with the tag 'administration'.
     *
     * @param $destinataire | The destinataire of the message
     */
    public function administrationMessage($destinataire)
    {
        $this->buildMessage(
            '[ADMIN][ZBOARD] || Information admin',
            $destinataire,
            $this->templating->render(':Emails/Administration:administration.html.twig'));
    }

    /**
     * Create a message with the tag 'important'.
     *
     * @param $destinataire | The destinataire of the message
     */
    public function importantMessage($destinataire)
    {
        $this->buildMessage(
            '[IMPORTANT][ZBOARD] || Information importante',
            $destinataire,
            $this->templating->render('Emails/Important/important.html.twig'));
    }

    /**
     * Create a message with the tag 'information'.
     *
     * @param $destinataire | The destinataire of the message
     */
    public function informationMessage($destinataire)
    {
        $this->buildMessage(
            '[INFORMATION][ZBOARD] || Information',
            $destinataire,
            $this->templating->render(':Emails/Information:information.html.twig'));
    }

    /**
     * Create a message with the tag 'staff'.
     *
     * @param $destinataire | The destinataire of the message
     */
    public function staffMessage($destinataire)
    {
        $this->buildMessage(
            '[STAFF][ZBOARD] || Information staff',
            $destinataire,
            $this->templating->render(':Emails/Staff:staff.html.twig'));
    }
}
