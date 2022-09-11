<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

use Guanguans\Notify\Contracts\MessageInterface;
use Guanguans\Notify\Traits\CreateStaticAble;
use Guanguans\Notify\Traits\HasOptions;
use Symfony\Component\Mime\Email;

class EmailMessage extends Email implements MessageInterface
{
    use HasOptions;
    use CreateStaticAble;

    /**
     * @return array{subject: string|null, html: resource|string|null, text: resource|string|null, from: \Symfony\Component\Mime\Address[], to: \Symfony\Component\Mime\Address[], cc: \Symfony\Component\Mime\Address[], bcc: \Symfony\Component\Mime\Address[], reply_to: \Symfony\Component\Mime\Address[], attachments: \Symfony\Component\Mime\Part\DataPart[]}
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
