<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\DingTalkGroupBot\Messages;

class LinkMessage extends Message
{
    protected array $defined = [
        'title',
        'text',
        'messageUrl',
        'picUrl',
    ];

    protected function type(): string
    {
        return 'link';
    }
}