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

namespace Guanguans\Notify\PushDeer\Messages;

/**
 * @method self desp(mixed $desp)
 * @method self text(mixed $text)
 * @method self type(mixed $type)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $defined = [
        'text',
        'desp',
        'type',
    ];
    protected array $allowedValues = [
        // 'type' => ['text', 'markdown', 'image'],
    ];

    public function toHttpUri(): string
    {
        return 'message/push?pushkey={token}';
    }
}
