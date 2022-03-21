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

class TextMessage extends PushDeerMessage
{
    /**
     * @var string[]
     */
    protected $options = [
        'type' => 'text',
    ];

    public function __construct(string $text, string $desp = '')
    {
        parent::__construct($text, $desp);
    }
}
