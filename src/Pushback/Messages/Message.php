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

namespace Guanguans\Notify\Pushback\Messages;

/**
 * @method self action1(mixed $action1)
 * @method self action2(mixed $action2)
 * @method self body(mixed $body)
 * @method self id(mixed $id)
 * @method self reply(mixed $reply)
 * @method self title(mixed $title)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $required = [
        // 'id',
        // 'title',
    ];

    /** @var list<string> */
    protected array $defined = [
        'id',
        'title',
        'body',
        'action1',
        'action2',
        'reply',
    ];

    public function toHttpUri(): string
    {
        return 'v1/send';
    }
}
