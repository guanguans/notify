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

use GuzzleHttp\RequestOptions;

/**
 * @method self card(array $card)
 */
class CardMessage extends Message
{
    protected array $defined = [
        'card',
    ];

    protected array $allowedTypes = [
        'card' => 'array',
    ];

    public function toHttpOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'msg_type' => $this->type(),
                'card' => $this->getOption('card'),
            ],
        ];
    }

    protected function type(): string
    {
        return 'interactive';
    }
}
