<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Lark\Messages;

/**
 * @method self text($text)
 */
class TextMessage extends Message
{
    protected array $defined = [
        'text',
    ];

    protected function type(): string
    {
        return 'text';
    }
}
