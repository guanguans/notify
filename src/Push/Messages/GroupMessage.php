<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Push\Messages;

/**
 * @method self groupId($groupId)
 * @method self title($title)
 * @method self body($body)
 * @method self sound($sound)
 * @method self channel($channel)
 * @method self link($link)
 * @method self image($image)
 * @method self timeSensitive(bool $timeSensitive)
 */
class GroupMessage extends Message
{
    public function toHttpUri(): string
    {
        return "api/v1/notify/group/{$this->getOption('groupId')}";
    }
}
