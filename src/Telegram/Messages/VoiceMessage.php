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
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage voice($voice)
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage caption($caption)
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage parseMode($parseMode)
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage captionEntities($captionEntities)
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage duration($duration)
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\VoiceMessage replyMarkup($replyMarkup)
 */
class VoiceMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'chat_id',
        'voice',
        'caption',
        'parse_mode',
        'caption_entities',
        'duration',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
