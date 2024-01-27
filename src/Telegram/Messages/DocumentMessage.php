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
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage document($document)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage thumb($thumb)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage caption($caption)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage parseMode($parseMode)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage captionEntities($captionEntities)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage disableContentTypeDetection($disableContentTypeDetection)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\DocumentMessage replyMarkup($replyMarkup)
 */
class DocumentMessage extends Message
{
    /**
     * @var array<string>
     */
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
