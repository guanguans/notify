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

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\Push\UriTemplateCredential;

/**
 * @method \Guanguans\Notify\Push\Messages\Message title($title)
 * @method \Guanguans\Notify\Push\Messages\Message body($body)
 * @method \Guanguans\Notify\Push\Messages\Message link($link)
 * @method \Guanguans\Notify\Push\Messages\Message image($image)
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
        'body',
        'link',
        'image',
    ];

    /**
     * @var array<string>
     */
    protected array $required = [
        'title',
        'body',
    ];

    public function httpUri()
    {
        return sprintf('https://push.techulus.com/api/v1/notify/%s', UriTemplateCredential::TEMPLATE_TOKEN);
    }
}
