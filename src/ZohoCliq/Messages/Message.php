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

/**
 * @method self bot(array $bot)
 * @method self buttons(array $buttons)
 * @method self card(array $card)
 * @method self slides(array $slides)
 * @method self styles(array $styles)
 * @method self text(mixed $text)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $defined = [
        'text',
        'bot',
        'card',
        'slides',
        'buttons',
        'styles',
    ];
    protected array $allowedTypes = [
        'bot' => 'array',
        'card' => 'array',
        'slides' => 'array',
        'buttons' => 'array',
        'styles' => 'array',
    ];

    public function toHttpUri(): string
    {
        return 'company/{companyId}/api/v2/channelsbyname/{channelUniqueName}/message';
    }
}
