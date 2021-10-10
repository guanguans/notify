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

class LinkMessage extends Message
{
    protected $type = 'link';

    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'text',
        'messageUrl',
        'picUrl',
    ];

    public function transformToRequestParams()
    {
        return [
            'msgtype' => $this->type,
            $this->type => $this->getOption(),
        ];
    }
}
