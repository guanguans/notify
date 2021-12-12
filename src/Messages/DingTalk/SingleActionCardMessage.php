<?php

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

    public function transformToRequestParams()
    {
        return [
            'msgtype' => $this->type,
            $this->type => $this->getOptions(),
        ];
    }
}
