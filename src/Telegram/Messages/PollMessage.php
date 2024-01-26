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

/**
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage question($question)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage options($options)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage isAnonymous($isAnonymous)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage type($type)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage allowsMultipleAnswers($allowsMultipleAnswers)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage correctOptionId($correctOptionId)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage explanation($explanation)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage explanationParseMode($explanationParseMode)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage explanationEntities($explanationEntities)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage openPeriod($openPeriod)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage closeDate($closeDate)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage isClosed($isClosed)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\PollMessage replyMarkup($replyMarkup)
 */
class PollMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
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
