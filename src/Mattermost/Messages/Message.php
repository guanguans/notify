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

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

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

    protected array $required = [
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

    public function __construct(string $baseUri, array $options)
    {
        parent::__construct($options);
        $this->baseUri = $baseUri;
    }

    public function httpUri()
    {
        return "$this->baseUri/api/v4/posts";
    }

    public function baseUri(string $baseUri): Message
    {
        $this->baseUri = $baseUri;

        return $this;
    }
}
