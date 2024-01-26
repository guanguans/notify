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
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage audio($audio)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage caption($caption)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage parseMode($parseMode)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage captionEntities($captionEntities)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage duration($duration)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage performer($performer)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage title($title)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage thumb($thumb)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\AudioMessage replyMarkup($replyMarkup)
 */
class AudioMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'chat_id',
        'audio',
        'caption',
        'parse_mode',
        'caption_entities',
        'duration',
        'performer',
        'title',
        'thumb',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
