<?php

declare(strict_types=1);

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
    /**
     * @var array<string>
     */
    protected array $defined = [
        'type',
        'to',
        'content',
    ];

    /**
     * @var array<string>
     */
    protected array $required = [
        'type',
        'to',
        'content',
    ];

    /**
     * @var array<string>
     */
    protected array $defaults = [
        'type' => 'private',
    ];

    /**
     * @var array<array<\string>>
     */
    protected array $allowedValues = [
        'type' => ['private'],
    ];

    public function __construct(string $to, string $content)
    {
        parent::__construct([
            'to' => $to,
            'content' => $content,
        ]);
    }
}
