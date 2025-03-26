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

namespace Guanguans\Notify\Bark\Messages;

/**
 * @method self autoCopy(mixed $autoCopy)
 * @method self badge(mixed $badge)
 * @method self body(mixed $body)
 * @method self copy(mixed $copy)
 * @method self group(mixed $group)
 * @method self icon(mixed $icon)
 * @method self isArchive(mixed $isArchive)
 * @method self level(mixed $level)
 * @method self sound(mixed $sound)
 * @method self title(mixed $title)
 * @method self url(mixed $url)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $defined = [
        'title',
        'body',
        'level',
        'badge',
        'autoCopy',
        'copy',
        'sound',
        'icon',
        'group',
        'isArchive',
        'url',
    ];
    protected array $allowedValues = [
        // 'level' => ['active', 'timeSensitive', 'passive'],
    ];

    public function toHttpUri(): string
    {
        return '{token}';
    }
}
