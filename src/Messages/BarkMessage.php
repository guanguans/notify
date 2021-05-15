<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

class BarkMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'text',
        'sound',
        'isArchive',
        'url',
        'copy',
        'automaticallyCopy',
    ];

    /**
     * @var array
     */
    protected $options = [
        'sound' => 'bell',
        'isArchive' => '1',
        'automaticallyCopy' => 1,
    ];
}
