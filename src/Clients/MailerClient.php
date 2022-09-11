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
    /**
     * @var string[]
     */
    protected $defined = [
        'message',
        'dsn',
        'envelope',
    ];

    /**
     * @var array<string, mixed>
     */
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

    /** @noRector \Rector\TypeDeclaration\Rector\FunctionLike\ReturnTypeDeclarationRector */
    protected function createMailer(): MailerInterface
    {
        return new Mailer(Transport::fromDsn($this->getDsn()));
    }

    public function send(MessageInterface $message = null)
    {
        $message and $this->setMessage($message);

        /* @noRector \Rector\CodingStyle\Rector\Closure\StaticClosureRector */
        return $this->wrapSendCallbacks(function (): void {
            $this->createMailer()->send($this->getMessage(), $this->getEnvelope());
        });
    }
}
