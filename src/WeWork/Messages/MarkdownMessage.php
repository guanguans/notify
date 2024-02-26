<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\WeWork\Messages;

/**
 * @method self content($content)
 */
class MarkdownMessage extends Message
{
    protected array $defined = [
        'content',
    ];

    protected function type(): string
    {
        return 'markdown';
    }
}
