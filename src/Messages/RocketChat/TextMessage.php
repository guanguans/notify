<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\RocketChat;

use Guanguans\Notify\Messages\Message;

class TextMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'text',
    ];

    /**
     * @var string[]
     */
    protected $required = [
        'text',
    ];

    public function __construct(string $text)
    {
        parent::__construct([
            'text' => $text,
        ]);
    }
}
