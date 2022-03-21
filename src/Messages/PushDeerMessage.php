<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

class PushDeerMessage extends Message
{
    protected $defined = [
        'text',
        'desp',
        'type',
    ];

    public function __construct(string $text, string $desp = '', string $type = '')
    {
        parent::__construct([
            'text' => $text,
            'desp' => $desp,
            'type' => $type,
        ]);
    }
}
