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
 * @method \Guanguans\Notify\Zulip\Messages\StreamMessage type($type)
 * @method \Guanguans\Notify\Zulip\Messages\StreamMessage to($to)
 * @method \Guanguans\Notify\Zulip\Messages\StreamMessage content($content)
 * @method \Guanguans\Notify\Zulip\Messages\StreamMessage topic($topic)
 * @method \Guanguans\Notify\Zulip\Messages\StreamMessage queueId($queueId)
 * @method \Guanguans\Notify\Zulip\Messages\StreamMessage localId($localId)
 */
class StreamMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'type',
        'to',
        'content',
        'topic',
        'queue_id',
        'local_id',
    ];

    /**
     * @var string[]
     */
    protected $required = [
        'type',
        'to',
        'content',
        'topic',
    ];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'to' => ['string', 'int'],
        'content' => 'string',
        'topic' => 'string',
        'queue_id' => 'string',
        'local_id' => 'string',
    ];

    /**
     * @var string[]
     */
    protected $defaults = [
        'type' => 'stream',
    ];

    /**
     * @var \string[][]
     */
    protected $allowedValues = [
        'type' => ['stream'],
    ];
}
