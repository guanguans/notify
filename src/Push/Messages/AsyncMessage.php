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

namespace Guanguans\Notify\Push\Messages;

/**
 * @method self body(mixed $body)
 * @method self channel(mixed $channel)
 * @method self groupId(mixed $groupId)
 * @method self image(mixed $image)
 * @method self link(mixed $link)
 * @method self sound(mixed $sound)
 * @method self timeSensitive(bool $timeSensitive)
 * @method self title(mixed $title)
 */
class AsyncMessage extends Message
{
    public function toHttpUri(): string
    {
        return 'api/v1/notify-async';
    }
}
