<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

class GoogleChatMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'text',
        'cards',
        'name',
        'sender',
        'createTime',
        'lastUpdateTime',
        'previewText',
        'annotations',
        'thread',
        'space',
        'fallbackText',
        'actionResponse',
        'argumentText',
        'slashCommand',
        'attachment',
    ];

    /**
     * @var string[]
     */
    protected $allowedTypes = [
        'cards' => 'array',
        'sender' => 'array',
        'annotations' => 'array',
        'thread' => 'array',
        'space' => 'array',
        'actionResponse' => 'array',
        'slashCommand' => 'array',
        'attachment' => 'array',
    ];
}
