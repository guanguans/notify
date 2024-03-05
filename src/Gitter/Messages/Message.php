<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Gitter\Messages;

/**
 * @method self text($text)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $defined = [
        'text',
    ];

    public function toHttpUri(): string
    {
        return 'v1/rooms/{roomId}/chatMessages';
    }
}
