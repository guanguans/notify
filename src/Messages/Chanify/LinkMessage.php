<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\Chanify;

use Guanguans\Notify\Messages\Message;

class LinkMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'link',
        'sound',
        'priority',
    ];

    /**
     * @var array<mixed>
     */
    protected array $options = [
        'sound' => 0,
        'priority' => 10,
    ];
}
