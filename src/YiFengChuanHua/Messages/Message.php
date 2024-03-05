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

/**
 * @method self head($head)
 * @method self body($body)
 * @method self delayMilliseconds($delayMilliseconds)
 * @method self url($url)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $required = [
        // 'head',
    ];

    protected array $defined = [
        'head',
        'body',
        'delayMilliseconds',
        'url',
    ];

    public function toHttpUri(): string
    {
        return 'services/push/send/{token}';
    }
}
