<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\YiFengChuanHua\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\YiFengChuanHua\UriTemplateCredential;

/**
 * @method \Guanguans\Notify\YiFengChuanHua\Messages\Message head($head)
 * @method \Guanguans\Notify\YiFengChuanHua\Messages\Message body($body)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    /**
     * @var array<string>
     */
    protected array $defined = [
        'head',
        'body',
    ];

    /**
     * @var array<string>
     */
    protected array $required = [
        'head',
    ];

    public function httpUri()
    {
        return sprintf('https://www.phprm.com/services/push/trigger/%s', UriTemplateCredential::TEMPLATE_TOKEN);
    }
}
