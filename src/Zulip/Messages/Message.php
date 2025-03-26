<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Zulip\Messages;

use Guanguans\Notify\Foundation\Concerns\AsFormParams;

/**
 * @method self content(mixed $content)
 * @method self localId(mixed $localId)
 * @method self queueId(mixed $queueId)
 * @method self readBySender(bool $readBySender)
 * @method self to(mixed $to)
 * @method self topic(mixed $topic)
 * @method self type(mixed $type)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsFormParams;
    protected array $required = [
        // 'type',
        // 'to',
        // 'content',
        // // 'topic', // stream
    ];
    protected array $defined = [
        'type',
        'to',
        'content',
        'topic',
        'queue_id',
        'local_id',
        'read_by_sender',
    ];
    protected array $allowedValues = [
        // 'type' => ['direct', 'private', 'stream'],
    ];
    protected array $allowedTypes = [
        'read_by_sender' => 'bool',
    ];

    public function toHttpUri(): string
    {
        return 'api/v1/messages';
    }
}
