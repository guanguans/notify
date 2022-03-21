<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\PushDeer;

use Guanguans\Notify\Messages\PushDeerMessage;

class ImageMessage extends PushDeerMessage
{
    /**
     * @var string[]
     */
    protected $options = [
        'type' => 'image',
    ];

    public function __construct(string $url, string $desp = '')
    {
        parent::__construct($url, $desp);
    }
}
