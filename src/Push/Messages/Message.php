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

namespace Guanguans\Notify\Push\Messages;

use Guanguans\Notify\Foundation\Support\Arr;

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
class Message extends \Guanguans\Notify\Foundation\Message
{
    /** @var list<string> */
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

    /** @var array<string, list<string>|string> */
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
