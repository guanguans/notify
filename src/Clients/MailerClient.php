<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Guanguans\Notify\Contracts\MessageInterface;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;

/**
 * @see https://symfony.com/doc/current/mailer.html
 * @see https://github.com/symfony/mailer
 */
class MailerClient extends Client
{
    protected $defined = [
        'message',
        'dsn',
        'envelope',
    ];

    protected $options = [
        'envelope' => null,
    ];

    public function getRequestUrl(): string
    {
        return '';
    }

    public function getDsn(): string
    {
        return $this->getOption('dsn');
    }

    public function setDsn(string $dsn): self
    {
        return $this->setOption('dsn', $dsn);
    }

    public function getEnvelope(): ?Envelope
    {
        return $this->getOption('envelope');
    }

    public function setEnvelope(?Envelope $envelope): self
    {
        return $this->setOption('envelope', $envelope);
    }

    protected function createMailer(): MailerInterface
    {
        return new Mailer(Transport::fromDsn($this->getDsn()));
    }

    public function send(MessageInterface $message = null)
    {
        $message and $this->setMessage($message);

        $this->callSendingCallbacks();

        $this->response = $this->createMailer()->send($this->getMessage(), $this->getEnvelope());

        $this->callSendedCallbacks();

        return $this->response;
    }
}
