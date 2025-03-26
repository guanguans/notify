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
 * @method self action(mixed $action)
 * @method self chatId(mixed $chatId)
 * @method self messageThreadId(mixed $messageThreadId)
 */
class ChatActionMessage extends Message
{
    protected array $defined = [
        'chat_id',
        'message_thread_id',
        'action',
    ];

    public function toHttpUri(): string
    {
        return 'bot{token}/sendChatAction';
    }
}
