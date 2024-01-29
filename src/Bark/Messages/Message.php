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

use Guanguans\Notify\Bark\Credential;
use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method \Guanguans\Notify\Bark\Messages\Message title($title)
 * @method \Guanguans\Notify\Bark\Messages\Message body($body)
 * @method \Guanguans\Notify\Bark\Messages\Message copy($copy)
 * @method \Guanguans\Notify\Bark\Messages\Message url($url)
 * @method \Guanguans\Notify\Bark\Messages\Message sound($sound)
 * @method \Guanguans\Notify\Bark\Messages\Message icon($icon)
 * @method \Guanguans\Notify\Bark\Messages\Message group($group)
 * @method \Guanguans\Notify\Bark\Messages\Message level($level)
 * @method \Guanguans\Notify\Bark\Messages\Message badge($badge)
 * @method \Guanguans\Notify\Bark\Messages\Message isArchive($isArchive)
 * @method \Guanguans\Notify\Bark\Messages\Message autoCopy($autoCopy)
 * @method \Guanguans\Notify\Bark\Messages\Message automaticallyCopy($automaticallyCopy)
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

    protected array $options = [
        // 'sound' => 'bell',
        // 'isArchive' => 1,
        // 'autoCopy' => 1,
        // 'automaticallyCopy' => 1,
    ];

    public function toHttpUri()
    {
        return sprintf('https://api.day.app/%s', Credential::TEMPLATE);
    }
}
