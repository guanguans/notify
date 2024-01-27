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

class PushPlusMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'title',
        'content',
        'template',
        'topic',
        'token',
    ];

    /**
     * @var array<string>
     */
    protected array $required = [
        'content',
    ];

    /**
     * @var array<array<\string>>
     */
    protected array $allowedValues = [
        'template' => ['html', 'json', 'cloudMonitor'],
    ];
}
