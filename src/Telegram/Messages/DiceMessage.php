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
 * @method \Guanguans\Notify\Telegram\Messages\DiceMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\DiceMessage emoji($emoji)
 * @method \Guanguans\Notify\Telegram\Messages\DiceMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\DiceMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\DiceMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\DiceMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\DiceMessage replyMarkup($replyMarkup)
 */
class DiceMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'chat_id',
        'emoji',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
