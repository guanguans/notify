<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\Zulip;

use Guanguans\Notify\Messages\Message;

class StreamMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'type',
        'to',
        'content',
        'topic',
        'queue_id',
        'local_id',
    ];

    /**
     * @var array<string>
     */
    protected array $required = [
        'type',
        'to',
        'content',
        'topic',
    ];

    protected array $allowedTypes = [
        'to' => ['string', 'int'],
        'content' => 'string',
        'topic' => 'string',
        'queue_id' => 'string',
        'local_id' => 'string',
    ];

    /**
     * @var array<string>
     */
    protected array $defaults = [
        'type' => 'stream',
    ];

    /**
     * @var array<array<\string>>
     */
    protected array $allowedValues = [
        'type' => ['stream'],
    ];
}
