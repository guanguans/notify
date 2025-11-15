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

namespace Guanguans\Notify\ZohoCliq\Messages;

use Guanguans\Notify\Foundation\Support\Arr;

/**
 * @method self bot(array $bot)
 * @method self buttons(array $buttons)
 * @method self card(array $card)
 * @method self slides(array $slides)
 * @method self styles(array $styles)
 * @method self text(mixed $text)
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
    ];

    public function toHttpUri(): string
    {
        return "api/v2/chats/{$this->getOption('chat_id')}/message";
    }

    protected function toPayload(): array
    {
        return Arr::except(parent::toPayload(), ['chat_id']);
    }
}
