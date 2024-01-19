<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Mailer\Messages;

use Guanguans\Notify\Foundation\Traits\HasOptions;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\Headers;
use Symfony\Component\Mime\Part\AbstractPart;

class Message extends Email implements \Guanguans\Notify\Foundation\Contracts\Message
{
    use HasOptions;

    public function __construct(Headers $headers = null, AbstractPart $body = null)
    {
        parent::__construct($headers, $body);
    }

    public function toPayload(): array
    {
        return [
            'subject' => $this->getSubject(),
            'html' => $this->getHtmlBody(),
            'text' => $this->getTextBody(),
            'from' => $this->getFrom(),
            'to' => $this->getTo(),
            'cc' => $this->getCc(),
            'bcc' => $this->getBcc(),
            'reply_to' => $this->getReplyTo(),
            'attachments' => $this->getAttachments(),
        ];
    }
}
