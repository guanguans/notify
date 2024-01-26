<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Zulip\Messages;

/**
 * @method \Guanguans\Notify\Zulip\Messages\PrivateMessage type($type)
 * @method \Guanguans\Notify\Zulip\Messages\PrivateMessage to($to)
 * @method \Guanguans\Notify\Zulip\Messages\PrivateMessage content($content)
 */
class PrivateMessage extends Message
{
    public function __construct(string $to, string $content)
    {
        parent::__construct([
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

    /**
     * @var string[]
     */
    protected $defaults = [
        'type' => 'private',
    ];

    /**
     * @var \string[][]
     */
    protected $allowedValues = [
        'type' => ['private'],
    ];
}
