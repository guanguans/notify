<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\Zulip;

use Guanguans\Notify\Messages\Message;

class PrivateMessage extends Message
{
    protected $type = 'private';

    public function __construct(string $to, string $content)
    {
        parent::__construct([
            'type' => $this->type,
            'to' => $to,
            'content' => $content,
        ]);
    }

    /**
     * @var string[]
     */
    protected $defined = [
        'type',
        'to',
        'content',
    ];

    /**
     * @var string[]
     */
    protected $required = [
        'type',
        'to',
        'content',
    ];
}
