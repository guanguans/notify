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
 * @method \Guanguans\Notify\Telegram\Messages\MediaGroupMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\MediaGroupMessage media($media)
 * @method \Guanguans\Notify\Telegram\Messages\MediaGroupMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\MediaGroupMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\MediaGroupMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\MediaGroupMessage allowSendingWithoutReply($allowSendingWithoutReply)
 */
class MediaGroupMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'chat_id',
        'media',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
    ];
}
