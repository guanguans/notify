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
 * @method self chatId($chatId)
 * @method self question($question)
 * @method self options($options)
 * @method self isAnonymous($isAnonymous)
 * @method self type($type)
 * @method self allowsMultipleAnswers($allowsMultipleAnswers)
 * @method self correctOptionId($correctOptionId)
 * @method self explanation($explanation)
 * @method self explanationParseMode($explanationParseMode)
 * @method self explanationEntities($explanationEntities)
 * @method self openPeriod($openPeriod)
 * @method self closeDate($closeDate)
 * @method self isClosed($isClosed)
 * @method self disableNotification($disableNotification)
 * @method self protectContent($protectContent)
 * @method self replyToMessageId($replyToMessageId)
 * @method self allowSendingWithoutReply($allowSendingWithoutReply)
 * @method self replyMarkup($replyMarkup)
 */
class PollMessage extends Message
{
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
