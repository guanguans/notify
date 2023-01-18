<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\DingTalk;

use Guanguans\Notify\Messages\Message;

class SingleActionCardMessage extends Message
{
    /**
     * @var string
     */
    protected $type = 'actionCard';

    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'text',
        'singleTitle',
        'singleURL',
        'btnOrientation',
    ];

    /**
     * @var array
     */
    protected $options = [
        'btnOrientation' => 0,
    ];

    /**
     * @return array<int|string, mixed>
     */
    public function transformToRequestParams(): array
    {
        return [
            'msgtype' => $this->type,
            $this->type => $this->getOptions(),
        ];
    }
}
