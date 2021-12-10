<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\FeiShu;

use Guanguans\Notify\Messages\Message;

class CardMessage extends Message
{
    protected $type = 'card';

    /**
     * @var string[]
     */
    protected $defined = [
        'card',
    ];

    protected $allowedTypes = [
        'card' => 'array',
    ];

    public function __construct(array $card)
    {
        parent::__construct([
            'card' => $card,
        ]);
    }

    public function transformToRequestParams()
    {
        return [
            'msg_type' => 'interactive',
            $this->type => $this->getOption('card'),
        ];
    }
}
