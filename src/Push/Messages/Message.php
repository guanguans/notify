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

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'body',
        'link',
        'image',
    ];

    /**
     * @var string[]
     */
    protected $required = [
        'title',
        'body',
    ];

    public function httpUri()
    {
        return sprintf('https://push.techulus.com/api/v1/notify/%s', UriTemplateCredential::TEMPLATE_TOKEN);
    }
}
