<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\Telegram;

use Guanguans\Notify\Messages\Message;

class AudioMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'chat_id',
        'audio',
        'caption',
        'parse_mode',
        'caption_entities',
        'duration',
        'performer',
        'title',
        'thumb',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
