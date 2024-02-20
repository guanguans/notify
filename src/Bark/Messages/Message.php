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

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method self title($title)
 * @method self body($body)
 * @method self copy($copy)
 * @method self url($url)
 * @method self sound($sound)
 * @method self icon($icon)
 * @method self group($group)
 * @method self level($level)
 * @method self badge($badge)
 * @method self isArchive($isArchive)
 * @method self autoCopy($autoCopy)
 * @method self automaticallyCopy($automaticallyCopy)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'title',
        'body',
        'copy',
        'url',
        'sound',
        'icon',
        'group',
        'level',
        'badge',
        'isArchive',
        'autoCopy',
        'automaticallyCopy',
    ];

    protected array $allowedTypes = [
        'badge' => 'int',
        'isArchive' => 'int',
        'autoCopy' => 'int',
        'automaticallyCopy' => 'int',
    ];

    protected array $allowedValues = [
        'level' => ['active', 'timeSensitive', 'passive'],
    ];

    public function toHttpUri(): string
    {
        return '{token}';
    }
}
