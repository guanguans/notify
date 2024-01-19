<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Logger\Messages;

class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $defined = [
        'level',
        'message',
        'context',
    ];

    protected array $required = [
        'level',
        'message',
    ];

    public function __construct(string $level, string $message, array $context = [])
    {
        parent::__construct(['level' => $level, 'message' => $message, 'context' => $context]);
    }
}
