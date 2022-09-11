<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\Chanify;

use Guanguans\Notify\Messages\Message;

class LinkMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'link',
        'sound',
        'priority',
    ];

    /**
     * @var mixed[]
     */
    protected $options = [
        'sound' => 0,
        'priority' => 10,
    ];
}
