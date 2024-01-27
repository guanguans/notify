<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\IGot\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\IGot\UriTemplateCredential;

/**
 * @method \Guanguans\Notify\IGot\Messages\Message title($title)
 * @method \Guanguans\Notify\IGot\Messages\Message content($content)
 * @method \Guanguans\Notify\IGot\Messages\Message url($url)
 * @method \Guanguans\Notify\IGot\Messages\Message automaticallyCopy($automaticallyCopy)
 * @method \Guanguans\Notify\IGot\Messages\Message urgent($urgent)
 * @method \Guanguans\Notify\IGot\Messages\Message copy($copy)
 * @method \Guanguans\Notify\IGot\Messages\Message detail(array $detail)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

    protected array $defined = [
        'title',
        'content',
        'url',
        'automaticallyCopy',
        'urgent',
        'copy',
        'detail',
    ];

    protected array $required = [
        'content',
    ];

    protected array $allowedTypes = [
        'automaticallyCopy' => 'int',
        'urgent' => 'int',
        'detail' => 'array',
    ];

    public function httpUri()
    {
        return sprintf('https://push.hellyw.com/%s', UriTemplateCredential::TEMPLATE_TOKEN);
    }
}
