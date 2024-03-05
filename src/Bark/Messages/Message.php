<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Bark\Messages;

/**
 * @method self title($title)
 * @method self body($body)
 * @method self level($level)
 * @method self badge($badge)
 * @method self autoCopy($autoCopy)
 * @method self copy($copy)
 * @method self sound($sound)
 * @method self icon($icon)
 * @method self group($group)
 * @method self isArchive($isArchive)
 * @method self url($url)
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
