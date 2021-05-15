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

class ShareChatMessage extends Message
{
    protected $type = 'share_chat';

    public function __construct(string $shareChatId = '')
    {
        parent::__construct([
            'share_chat_id' => $shareChatId,
        ]);
    }

    /**
     * @var string[]
     */
    protected $defined = [
        'share_chat_id',
    ];

    public function transformToRequestParams()
    {
        return [
            'msg_type' => $this->type,
            'content' => $this->getOptions(),
        ];
    }
}
