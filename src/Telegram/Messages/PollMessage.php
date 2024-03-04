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
 * @method self messageThreadId($messageThreadId)
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
 * @method self replyParameters($replyParameters)
 * @method self replyMarkup($replyMarkup)
 */
class PollMessage extends Message
{
    protected array $defined = [
        'chat_id',
        'message_thread_id',
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
        'reply_parameters',
        'reply_markup',
    ];

    protected array $options = [
        'explanation_entities' => [],
    ];

    public function addExplanationEntity(array $explanationEntity): self
    {
        $this->options['explanation_entities'][] = $explanationEntity;

        return $this;
    }
}
