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

use Guanguans\Notify\Foundation\Concerns\AsFormParams;
use Guanguans\Notify\Foundation\Concerns\AsPost;

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsFormParams;
    use AsPost;

    protected array $defined = [
        'type',
        'to',
        'content',
        'topic',
        'queue_id',
        'local_id',
        'read_by_sender',
    ];

    protected array $required = [
        'type',
        'to',
        'content',
        // 'topic', // stream
    ];

    protected array $allowedValues = [
        'type' => ['direct', 'private', 'stream'],
    ];

    protected array $allowedTypes = [
        'read_by_sender' => 'bool',
    ];

    public function toHttpUri(): string
    {
        return 'api/v1/messages';
    }
}
