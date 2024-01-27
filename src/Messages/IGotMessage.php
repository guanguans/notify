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

class IGotMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'title',
        'content',
        'url',
        'automaticallyCopy',
        'urgent',
        'copy',
        'detail',
    ];

    /**
     * @var array<string>
     */
    protected array $required = [
        'content',
    ];

    protected array $allowedTypes = [
        'automaticallyCopy' => 'int',
        'urgent' => 'int',
        'detail' => 'array',
    ];
}
