<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

class ServerChanMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'desp',
    ];
}
