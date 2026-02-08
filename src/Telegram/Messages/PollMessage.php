<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Telegram\Messages;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self allowsMultipleAnswers(mixed $allowsMultipleAnswers)
 * @method self chatId(mixed $chatId)
 * @method self closeDate(mixed $closeDate)
 * @method self correctOptionId(mixed $correctOptionId)
 * @method self disableNotification(mixed $disableNotification)
 * @method self explanation(mixed $explanation)
 * @method self explanationEntities(array $explanationEntities)
 * @method self explanationParseMode(mixed $explanationParseMode)
 * @method self isAnonymous(mixed $isAnonymous)
 * @method self isClosed(mixed $isClosed)
 * @method self messageThreadId(mixed $messageThreadId)
 * @method self openPeriod(mixed $openPeriod)
 * @method self options(mixed $options)
 * @method self protectContent(mixed $protectContent)
 * @method self question(mixed $question)
 * @method self replyMarkup(mixed $replyMarkup)
 * @method self replyParameters(mixed $replyParameters)
 * @method self type(mixed $type)
 */
class PollMessage extends Message
{
    /** @var list<string> */
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

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'explanation_entities' => 'array[]',
    ];

    /** @var array<string, mixed> */
    protected array $options = [
        'explanation_entities' => [],
    ];

    /**
     * @api
     *
     * @param array<array-key, mixed> $explanationEntity
     */
    public function addExplanationEntity(array $explanationEntity): self
    {
        $this->options['explanation_entities'][] = $explanationEntity;

        return $this;
    }

    public function toHttpUri(): string
    {
        return 'bot{token}/sendPoll';
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver
            ->setAllowedTypes('options', 'array')
            ->setNormalizer(
                'options',
                static fn (Options $options, array $value): string => json_encode($value, \JSON_THROW_ON_ERROR),
            );
    }
}
