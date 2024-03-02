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

/**
 * @method self head($head)
 * @method self body($body)
 * @method self delayMilliseconds($delayMilliseconds)
 * @method self url($url)
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
        'delayMilliseconds',
        'url',
    ];

    protected array $required = [
        'head',
    ];

    public function toHttpUri(): string
    {
        return 'https://www.phprm.com/services/push/send/{token}';
    }
}
