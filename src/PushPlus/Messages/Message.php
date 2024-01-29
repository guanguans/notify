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

/**
 * @method \Guanguans\Notify\PushPlus\Messages\Message title($title)
 * @method \Guanguans\Notify\PushPlus\Messages\Message content($content)
 * @method \Guanguans\Notify\PushPlus\Messages\Message template($template)
 * @method \Guanguans\Notify\PushPlus\Messages\Message topic($topic)
 * @method \Guanguans\Notify\PushPlus\Messages\Message token($token)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    /**
     * @var array<string>
     */
    protected array $defined = [
        'title',
        'content',
        'template',
        'topic',
        'token',
    ];

    /**
     * @var array<string>
     */
    protected array $required = [
        'content',
    ];

    /**
     * @var array<array<\string>>
     */
    protected array $allowedValues = [
        'template' => ['html', 'json', 'cloudMonitor'],
    ];

    public function toHttpUri()
    {
        return sprintf('https://www.pushplus.plus/send?token=%s', Credential::TEMPLATE);
    }
}
