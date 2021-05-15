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

class TextMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'text',
        'copy',
        'autocopy',
        'sound',
        'priority',
    ];

    /**
     * @var string[]
     */
    protected $options = [
        'autocopy' => 1,
        'sound' => 1,
        'priority' => 10,
    ];
}
