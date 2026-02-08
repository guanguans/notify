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
 * @method self chatId(mixed $chatId)
 * @method self disableNotification(mixed $disableNotification)
 * @method self duration(mixed $duration)
 * @method self length(mixed $length)
 * @method self messageThreadId(mixed $messageThreadId)
 * @method self protectContent(mixed $protectContent)
 * @method self replyMarkup(mixed $replyMarkup)
 * @method self replyParameters(mixed $replyParameters)
 * @method self thumbnail(mixed $thumbnail)
 * @method self videoNote(mixed $videoNote)
 */
class VideoNoteMessage extends AbstractMessage
{
    /** @var list<string> */
    protected array $defined = [
        'chat_id',
        'message_thread_id',
        'video_note',
        'duration',
        'length',
        'thumbnail',
        'disable_notification',
        'protect_content',
        'reply_parameters',
        'reply_markup',
    ];

    public function toHttpUri(): string
    {
        return 'bot{token}/sendVideoNote';
    }
}
