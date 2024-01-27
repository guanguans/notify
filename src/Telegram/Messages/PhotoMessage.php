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
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage photo($photo)
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage caption($caption)
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage parseMode($parseMode)
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage captionEntities($captionEntities)
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage disableWebPagePreview($disableWebPagePreview)
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\PhotoMessage replyMarkup($replyMarkup)
 */
class PhotoMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'chat_id',
        'photo',
        'caption',
        'parse_mode',
        'caption_entities',
        'disable_web_page_preview',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
