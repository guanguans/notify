<?php

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
     * @var string[]
     */
    protected $defined = [
        'message',
        'context',
    ];

    /**
     * @var string[]
     */
    protected $required = [
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
