<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Telegram\Messages;

/**
 * @method self animation(mixed $animation)
 * @method self caption(mixed $caption)
 * @method self captionEntities(mixed $captionEntities)
 * @method self chatId(mixed $chatId)
 * @method self disableNotification(mixed $disableNotification)
 * @method self duration(mixed $duration)
 * @method self hasSpoiler(mixed $hasSpoiler)
 * @method self height(mixed $height)
 * @method self messageThreadId(mixed $messageThreadId)
 * @method self parseMode(mixed $parseMode)
 * @method self protectContent(mixed $protectContent)
 * @method self replyMarkup(mixed $replyMarkup)
 * @method self replyParameters(mixed $replyParameters)
 * @method self thumbnail(mixed $thumbnail)
 * @method self width(mixed $width)
 */
class AnimationMessage extends Message
{
    protected array $defined = [
        'chat_id',
        'message_thread_id',
        'animation',
        'duration',
        'width',
        'height',
        'thumbnail',
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
        return 'bot{token}/sendAnimation';
    }

    public function addCaptionEntity(array $captionEntity): self
    {
        $this->options['caption_entities'][] = $captionEntity;

        return $this;
    }
}
