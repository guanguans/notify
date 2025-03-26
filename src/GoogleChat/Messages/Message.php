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

namespace Guanguans\Notify\GoogleChat\Messages;

/**
 * @method self actionResponse(array $actionResponse)
 * @method self annotations(array $annotations)
 * @method self argumentText(mixed $argumentText)
 * @method self attachment(array $attachment)
 * @method self cards(array $cards)
 * @method self createTime(mixed $createTime)
 * @method self fallbackText(mixed $fallbackText)
 * @method self lastUpdateTime(mixed $lastUpdateTime)
 * @method self name(mixed $name)
 * @method self previewText(mixed $previewText)
 * @method self sender(array $sender)
 * @method self slashCommand(array $slashCommand)
 * @method self space(array $space)
 * @method self text(mixed $text)
 * @method self thread(array $thread)
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
