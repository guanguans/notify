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

namespace Guanguans\Notify\AnPush\Messages;

use Guanguans\Notify\Foundation\Concerns\AsFormParams;

/**
 * @method self channel(mixed $channel)
 * @method self content(mixed $content)
 * @method self title(mixed $title)
 * @method self to(mixed $to)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsFormParams;

    /** @var list<string> */
    protected array $required = [
        // 'title',
        // 'channel',
    ];

    /** @var list<string> */
    protected array $defined = [
        'title',
        'content',
        'channel',
        'to',
    ];

    public function toHttpUri(): string
    {
        return 'push/{token}';
    }
}
