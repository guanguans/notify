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
 * @method self document($document)
 * @method self thumb($thumb)
 * @method self caption($caption)
 * @method self parseMode($parseMode)
 * @method self captionEntities($captionEntities)
 * @method self disableContentTypeDetection($disableContentTypeDetection)
 * @method self disableNotification($disableNotification)
 * @method self protectContent($protectContent)
 * @method self replyToMessageId($replyToMessageId)
 * @method self allowSendingWithoutReply($allowSendingWithoutReply)
 * @method self replyMarkup($replyMarkup)
 */
class DocumentMessage extends Message
{
    protected array $defined = [
        'chat_id',
        'document',
        'thumb',
        'caption',
        'parse_mode',
        'caption_entities',
        'disable_content_type_detection',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
