<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Showdoc\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\Showdoc\UriTemplateCredential;

/**
 * @method \Guanguans\Notify\Showdoc\Messages\Message title($title)
 * @method \Guanguans\Notify\Showdoc\Messages\Message content($content)
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
    ];

    public function __construct(string $title, string $content)
    {
        parent::__construct([
            'title' => $title,
            'content' => $content,
        ]);
    }

    public function httpUri()
    {
        return sprintf('https://push.showdoc.com.cn/server/api/push/%s', UriTemplateCredential::TEMPLATE_TOKEN);
    }
}
