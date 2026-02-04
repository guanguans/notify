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
 * @method self botUniqueName(mixed $botUniqueName)
 * @method self buttons(array $buttons)
 * @method self card(array $card)
 * @method self slides(array $slides)
 * @method self styles(array $styles)
 * @method self text(mixed $text)
 */
class BotMessage extends Message
{
    /** @var list<string> */
    protected array $defined = [
        'bot_unique_name',

        'text',
        'bot',
        'card',
        'styles',
        'slides',
        'buttons',
    ];

    public function toHttpUri(): string
    {
        return "api/v2/bots/{$this->getOption('bot_unique_name')}/message";
    }
}
