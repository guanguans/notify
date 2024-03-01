<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
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
        return "https://push.techulus.com/api/v1/notify/group/{$this->getOption('groupId')}";
    }
}
