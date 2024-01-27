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

class LoggerMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'message',
        'context',
    ];

    /**
     * @var array<string>
     */
    protected array $required = [
        'message',
    ];

    public function __construct(string $message, array $context = [])
    {
        parent::__construct([
            'message' => $message,
            'context' => $context,
        ]);
    }
}
