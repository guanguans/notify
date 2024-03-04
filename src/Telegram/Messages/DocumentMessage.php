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
 * @method self document($document)
 * @method self thumbnail($thumbnail)
 * @method self caption($caption)
 * @method self parseMode($parseMode)
 * @method self captionEntities($captionEntities)
 * @method self disableContentTypeDetection($disableContentTypeDetection)
 * @method self disableNotification($disableNotification)
 * @method self protectContent($protectContent)
 * @method self replyParameters($replyParameters)
 * @method self replyMarkup($replyMarkup)
 */
class DocumentMessage extends Message
{
    protected array $defined = [
        'chat_id',
        'message_thread_id',
        'document',
        'thumbnail',
        'caption',
        'parse_mode',
        'caption_entities',
        'disable_content_type_detection',
        'disable_notification',
        'protect_content',
        'reply_parameters',
        'reply_markup',
    ];

    protected array $options = [
        'caption_entities' => [],
    ];

    public function addCaptionEntity(array $captionEntity): self
    {
        $this->options['caption_entities'][] = $captionEntity;

        return $this;
    }
}
