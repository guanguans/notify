<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Telegram\Messages;

/**
 * @method self caption(mixed $caption)
 * @method self captionEntities(mixed $captionEntities)
 * @method self chatId(mixed $chatId)
 * @method self disableContentTypeDetection(mixed $disableContentTypeDetection)
 * @method self disableNotification(mixed $disableNotification)
 * @method self document(mixed $document)
 * @method self messageThreadId(mixed $messageThreadId)
 * @method self parseMode(mixed $parseMode)
 * @method self protectContent(mixed $protectContent)
 * @method self replyMarkup(mixed $replyMarkup)
 * @method self replyParameters(mixed $replyParameters)
 * @method self thumbnail(mixed $thumbnail)
 */
class DocumentMessage extends Message
{
    /** @var list<string> */
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

    /** @var array<string, mixed> */
    protected array $options = [
        'caption_entities' => [],
    ];

    public function toHttpUri(): string
    {
        return 'bot{token}/sendDocument';
    }

    /**
     * @api
     */
    public function addCaptionEntity(array $captionEntity): self
    {
        $this->options['caption_entities'][] = $captionEntity;

        return $this;
    }
}
