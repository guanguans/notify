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

class PushMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'title',
        'body',
        'link',
        'image',
    ];

    /**
     * @var array<string>
     */
    protected array $required = [
        'title',
        'body',
    ];
}
