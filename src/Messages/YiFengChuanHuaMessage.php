<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

class YiFengChuanHuaMessage extends Message
{
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
}
