<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Mattermost\Messages;

/**
 * @method self channelId(mixed $channelId)
 * @method self createAt(mixed $createAt)
 * @method self editAt(mixed $editAt)
 * @method self fileIds(array $fileIds)
 * @method self isPinned(bool $isPinned)
 * @method self message(mixed $message)
 * @method self originalId(mixed $originalId)
 * @method self participants(mixed $participants)
 * @method self pendingPostId(mixed $pendingPostId)
 * @method self props(array $props)
 * @method self rootId(mixed $rootId)
 * @method self type(mixed $type)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $required = [
        // 'channel_id',
    ];

    /** @var list<string> */
    protected array $defined = [
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

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'file_ids' => 'array',
        'props' => 'array',
        'is_pinned' => 'bool',
    ];

    public function toHttpUri(): string
    {
        return 'api/v4/posts';
    }
}
