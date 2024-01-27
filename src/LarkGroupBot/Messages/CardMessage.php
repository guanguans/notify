<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\LarkGroupBot\Messages;

/**
 * @method \Guanguans\Notify\LarkGroupBot\Messages\CardMessage card(array $card)
 */
class CardMessage extends Message
{
    protected array $defined = [
        'card',
    ];

    protected array $allowedTypes = [
        'card' => 'array',
    ];

    public function __construct(array $card)
    {
        parent::__construct(['card' => $card]);
    }

    protected function type(): string
    {
        return 'card';
    }
}
