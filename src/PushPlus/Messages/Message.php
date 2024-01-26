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
use Guanguans\Notify\PushPlus\UriTemplateCredential;

/**
 * @method \Guanguans\Notify\PushPlus\Messages\Message title($title)
 * @method \Guanguans\Notify\PushPlus\Messages\Message content($content)
 * @method \Guanguans\Notify\PushPlus\Messages\Message template($template)
 * @method \Guanguans\Notify\PushPlus\Messages\Message topic($topic)
 * @method \Guanguans\Notify\PushPlus\Messages\Message token($token)
 */
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
        return sprintf('https://www.pushplus.plus/send?token=%s', UriTemplateCredential::TEMPLATE_TOKEN);
    }
}
