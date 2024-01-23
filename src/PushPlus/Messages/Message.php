<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\PushPlus\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\PushPlus\Credential;

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'content',
        'template',
        'topic',
        'token',
    ];

    /**
     * @var string[]
     */
    protected $required = [
        'content',
    ];

    /**
     * @var \string[][]
     */
    protected $allowedValues = [
        'template' => ['html', 'json', 'cloudMonitor'],
    ];

    public function httpUri()
    {
        return sprintf('https://www.pushplus.plus/send?token=%s', Credential::TEMPLATE_TOKEN);
    }
}
