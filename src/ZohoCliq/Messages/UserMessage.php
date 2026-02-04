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
 * @method self emailId(mixed $emailId)
 * @method self slides(array $slides)
 * @method self styles(array $styles)
 * @method self text(mixed $text)
 */
class UserMessage extends Message
{
    protected array $defined = [
        'email_id',

        'text',
        'bot',
        'card',
        'styles',
        'slides',
        'buttons',
    ];

    public function toHttpUri(): string
    {
        return "api/v2/buddies/{$this->getOption('email_id')}/message";
    }
}
