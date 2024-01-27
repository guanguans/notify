<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\Telegram;

use Guanguans\Notify\Messages\Message;

class PollMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'chat_id',
        'question',
        'options',
        'is_anonymous',
        'type',
        'allows_multiple_answers',
        'correct_option_id',
        'explanation',
        'explanation_parse_mode',
        'explanation_entities',
        'open_period',
        'close_date',
        'is_closed',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
