<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Telegram\Messages;

class VoiceMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'chat_id',
        'voice',
        'caption',
        'parse_mode',
        'caption_entities',
        'duration',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
