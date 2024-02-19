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
 * @method \Guanguans\Notify\Zulip\Messages\DirectMessage type($type)
 * @method \Guanguans\Notify\Zulip\Messages\DirectMessage to($to)
 * @method \Guanguans\Notify\Zulip\Messages\DirectMessage content($content)
 */
class DirectMessage extends Message
{
    protected array $defined = [
        'type',
        'to',
        'content',
    ];

    protected array $required = [
        'type',
        'to',
        'content',
    ];

    protected array $defaults = [
        'type' => 'direct',
    ];

    protected array $allowedTypes = [
        'to' => ['string', 'int', 'array'],
    ];

    protected array $allowedValues = [
        'type' => ['direct'],
    ];

    protected array $options = [
        'type' => 'direct',
    ];
}
