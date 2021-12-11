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

    public function transformToRequestParams()
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
