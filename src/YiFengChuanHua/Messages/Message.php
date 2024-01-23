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
use Guanguans\Notify\YiFengChuanHua\Credential;

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

    /**
     * @var string[]
     */
    protected $defined = [
        'head',
        'body',
    ];

    /**
     * @var string[]
     */
    protected $required = [
        'head',
    ];

    public function httpUri()
    {
        return sprintf('https://www.phprm.com/services/push/trigger/%s', Credential::TEMPLATE_TOKEN);
    }
}
