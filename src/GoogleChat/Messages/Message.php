<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\GoogleChat\Messages;

/**
 * @method self text($text)
 * @method self cards(array $cards)
 * @method self name($name)
 * @method self sender(array $sender)
 * @method self createTime($createTime)
 * @method self lastUpdateTime($lastUpdateTime)
 * @method self previewText($previewText)
 * @method self annotations(array $annotations)
 * @method self thread(array $thread)
 * @method self space(array $space)
 * @method self fallbackText($fallbackText)
 * @method self actionResponse(array $actionResponse)
 * @method self argumentText($argumentText)
 * @method self slashCommand(array $slashCommand)
 * @method self attachment(array $attachment)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $defined = [
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

    protected array $allowedTypes = [
        'cards' => 'array',
        'sender' => 'array',
        'annotations' => 'array',
        'thread' => 'array',
        'space' => 'array',
        'actionResponse' => 'array',
        'slashCommand' => 'array',
        'attachment' => 'array',
    ];

    public function toHttpUri(): string
    {
        return 'v1/spaces/{spaceId}/messages';
    }
}
