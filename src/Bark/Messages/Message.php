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

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

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

    public function httpUri()
    {
        return sprintf('https://api.day.app/%s', Credential::TEMPLATE_TOKEN);
    }
}
