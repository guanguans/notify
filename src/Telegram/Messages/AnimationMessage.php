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
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage animation($animation)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage duration($duration)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage width($width)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage height($height)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage thumb($thumb)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage caption($caption)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage parseMode($parseMode)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage captionEntities($captionEntities)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\AnimationMessage replyMarkup($replyMarkup)
 */
class AnimationMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'chat_id',
        'animation',
        'duration',
        'width',
        'height',
        'thumb',
        'caption',
        'parse_mode',
        'caption_entities',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
