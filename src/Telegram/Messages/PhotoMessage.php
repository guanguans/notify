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
 * @method self messageThreadId($messageThreadId)
 * @method self photo($photo)
 * @method self caption($caption)
 * @method self parseMode($parseMode)
 * @method self captionEntities($captionEntities)
 * @method self hasSpoiler($hasSpoiler)
 * @method self disableNotification($disableNotification)
 * @method self protectContent($protectContent)
 * @method self replyParameters($replyParameters)
 * @method self replyMarkup($replyMarkup)
 */
class PhotoMessage extends Message
{
    protected array $defined = [
        'chat_id',
        'message_thread_id',
        'photo',
        'caption',
        'parse_mode',
        'caption_entities',
        'has_spoiler',
        'disable_notification',
        'protect_content',
        'reply_parameters',
        'reply_markup',
    ];

    protected array $options = [
        'caption_entities' => [],
    ];

    public function toHttpUri(): string
    {
        return 'bot{token}/sendPhoto';
    }

    public function addCaptionEntity(array $captionEntity): self
    {
        $this->options['caption_entities'][] = $captionEntity;

        return $this;
    }
}
