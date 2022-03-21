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
    /**
     * @var string[]
     */
    protected $defined = [
        'text',
        'desp',
        'type',
    ];

    /**
     * @var string[]
     */
    protected $required = [
        'text',
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
