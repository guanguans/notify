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

class MattermostMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'channel_id',
        'message',
        'file_ids',
        'create_at',
        'edit_at',
        'is_pinned',
        'root_id',
        'original_id',
        'type',
        'props',
        'pending_post_id',
        'participants',
    ];

    /**
     * @var string[]
     */
    protected $required = [
        'channel_id',
    ];

    /**
     * @var string[]
     */
    protected $allowedTypes = [
        'file_ids' => 'array',
        'props' => 'array',
        'is_pinned' => 'bool',
        'create_at' => 'int',
        'edit_at' => 'int',
    ];
}
