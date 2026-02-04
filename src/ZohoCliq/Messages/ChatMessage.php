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

namespace Guanguans\Notify\ZohoCliq\Messages;

/**
 * @method self bot(array $bot)
 * @method self buttons(array $buttons)
 * @method self card(array $card)
 * @method self chatId(mixed $chatId)
 * @method self postInParent(mixed $postInParent)
 * @method self slides(array $slides)
 * @method self styles(array $styles)
 * @method self text(mixed $text)
 * @method self threadMessageId(mixed $threadMessageId)
 * @method self threadTitle(mixed $threadTitle)
 */
class ChatMessage extends Message
{
    protected array $defined = [
        'chat_id',

        'text',
        'bot',
        'card',
        'styles',
        'slides',
        'buttons',

        // To send message in thread
        'thread_message_id',
        'thread_title',
        'post_in_parent',
    ];

    public function toHttpUri(): string
    {
        return "api/v2/chats/{$this->getOption('chat_id')}/message";
    }
}
