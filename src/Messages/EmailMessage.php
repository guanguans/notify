<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

use Guanguans\Notify\Contracts\MessageInterface;
use Guanguans\Notify\Traits\CreateStaticable;
use Guanguans\Notify\Traits\HasOptions;
use Symfony\Component\Mime\Email;

class EmailMessage extends Email implements MessageInterface
{
    use CreateStaticable;
    use HasOptions;

    /**
     * @return array{subject: null|string, html: null|resource|string, text: null|resource|string, from: array<\Symfony\Component\Mime\Address>, to: array<\Symfony\Component\Mime\Address>, cc: array<\Symfony\Component\Mime\Address>, bcc: array<\Symfony\Component\Mime\Address>, reply_to: array<\Symfony\Component\Mime\Address>, attachments: array<\Symfony\Component\Mime\Part\DataPart>}
     */
    public function transformToRequestParams(): array
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
