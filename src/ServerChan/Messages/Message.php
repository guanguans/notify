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

namespace Guanguans\Notify\ServerChan\Messages;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;

/**
 * @method self channel(mixed $channel)
 * @method self desp(mixed $desp)
 * @method self noip(mixed $noip)
 * @method self openid(mixed $openid)
 * @method self short(mixed $short)
 * @method self tags(mixed $tags)
 * @method self title(mixed $title)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsNullUri;
    protected array $defined = [
        'title',
        'desp',
        'tags',
        'short',
        'noip',
        'channel',
        'openid',

        // 'encoded',
        // 'key',
        // 'uid',
    ];
}
