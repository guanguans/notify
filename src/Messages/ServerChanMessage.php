<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

class ServerChanMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'title',
        'desp',
    ];

    public function __construct(string $title, string $desp = '')
    {
        parent::__construct([
            'title' => $title,
            'desp' => $desp,
        ]);
    }
}
