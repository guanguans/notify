<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\FeiShu;

class ShareChatMessage extends Message
{
    protected $type = 'share_chat';

    /**
     * @var string[]
     */
    protected $defined = [
        'share_chat_id',
        'secret',
    ];
}
