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
 * @method \Guanguans\Notify\Telegram\Messages\VideoNoteMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\VideoNoteMessage videoNote($videoNote)
 * @method \Guanguans\Notify\Telegram\Messages\VideoNoteMessage duration($duration)
 * @method \Guanguans\Notify\Telegram\Messages\VideoNoteMessage length($length)
 * @method \Guanguans\Notify\Telegram\Messages\VideoNoteMessage thumb($thumb)
 * @method \Guanguans\Notify\Telegram\Messages\VideoNoteMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\VideoNoteMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\VideoNoteMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\VideoNoteMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\VideoNoteMessage replyMarkup($replyMarkup)
 */
class VideoNoteMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'chat_id',
        'video_note',
        'duration',
        'length',
        'thumb',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
