<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Telegram\Messages;

/**
 * @method self chatId($chatId)
 * @method self video($video)
 * @method self duration($duration)
 * @method self width($width)
 * @method self height($height)
 * @method self thumb($thumb)
 * @method self caption($caption)
 * @method self parseMode($parseMode)
 * @method self captionEntities($captionEntities)
 * @method self supportsStreaming($supportsStreaming)
 * @method self disableNotification($disableNotification)
 * @method self protectContent($protectContent)
 * @method self replyToMessageId($replyToMessageId)
 * @method self allowSendingWithoutReply($allowSendingWithoutReply)
 * @method self replyMarkup($replyMarkup)
 */
class VideoMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'chat_id',
        'video',
        'duration',
        'width',
        'height',
        'thumb',
        'caption',
        'parse_mode',
        'caption_entities',
        'supports_streaming',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
