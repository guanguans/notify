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

use Guanguans\Notify\Foundation\Support\Arr;

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
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $defined = [
        'groupId',

        'title',
        'body',
        'sound',
        'channel',
        'link',
        'image',
        'timeSensitive',
    ];

    protected array $allowedTypes = [
        'timeSensitive' => 'bool',
    ];

    public function toHttpUri(): string
    {
        return 'api/v1/notify/{token}';
    }

    protected function toPayload(): array
    {
        return Arr::except(parent::toPayload(), ['groupId']);
    }
}
