<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\ShowdocPush\Messages;

/**
 * @method self title($title)
 * @method self content($content)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $defined = [
        'title',
        'content',
    ];

    public function toHttpUri(): string
    {
        return 'server/api/push/{token}';
    }
}
