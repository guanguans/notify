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
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage video($video)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage duration($duration)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage width($width)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage height($height)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage thumb($thumb)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage caption($caption)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage parseMode($parseMode)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage captionEntities($captionEntities)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage supportsStreaming($supportsStreaming)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\VideoMessage replyMarkup($replyMarkup)
 */
class VideoMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
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
