<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Zulip\Messages;

/**
 * @method self type($type)
 * @method self to($to)
 * @method self content($content)
 * @method self topic($topic)
 * @method self queueId($queueId)
 * @method self localId($localId)
 */
class StreamMessage extends Message
{
    protected array $defined = [
        'type',
        'to',
        'content',
        'topic',
        'queue_id',
        'local_id',
    ];

    protected array $required = [
        'type',
        'to',
        'content',
        'topic',
    ];

    protected array $allowedTypes = [
        'to' => ['string', 'int', 'array'],
        'content' => 'string',
        'topic' => 'string',
        'queue_id' => 'string',
        'local_id' => 'string',
    ];

    protected array $defaults = [
        'type' => 'stream',
    ];

    protected array $allowedValues = [
        'type' => ['stream'],
    ];
}
