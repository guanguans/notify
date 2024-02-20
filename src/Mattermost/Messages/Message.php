<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Mattermost\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method self baseUri($baseUri)
 * @method self channelId($channelId)
 * @method self message($message)
 * @method self fileIds(array $fileIds)
 * @method self createAt($createAt)
 * @method self editAt($editAt)
 * @method self isPinned($isPinned)
 * @method self rootId($rootId)
 * @method self originalId($originalId)
 * @method self type($type)
 * @method self props(array $props)
 * @method self pendingPostId($pendingPostId)
 * @method self participants($participants)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'base_uri',

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

    protected array $required = [
        'base_uri',
        'channel_id',
    ];

    protected array $allowedTypes = [
        'file_ids' => 'array',
        'props' => 'array',
        'is_pinned' => 'bool',
        'create_at' => 'int',
        'edit_at' => 'int',
    ];

    private string $baseUri;

    public function toHttpUri(): string
    {
        return "{$this->getOption('base_uri')}/api/v4/posts";
    }
}
