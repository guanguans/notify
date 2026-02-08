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
 * @method self chatId(mixed $chatId)
 * @method self disableNotification(mixed $disableNotification)
 * @method self media(array $media)
 * @method self messageThreadId(mixed $messageThreadId)
 * @method self protectContent(mixed $protectContent)
 * @method self replyParameters(mixed $replyParameters)
 */
class MediaGroupMessage extends AbstractMessage
{
    /** @var list<string> */
    protected array $defined = [
        'chat_id',
        'message_thread_id',
        'media',
        'disable_notification',
        'protect_content',
        'reply_parameters',
    ];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'media' => 'array[]',
    ];

    /** @var array<string, mixed> */
    protected array $options = [
        'media' => [],
    ];

    /**
     * @api
     *
     * @param array<array-key, mixed> $media
     */
    public function addMedia(array $media): self
    {
        $this->options['media'][] = $media;

        return $this;
    }

    public function toHttpUri(): string
    {
        return 'bot{token}/sendMediaGroup';
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setNormalizer(
            'media',
            static fn (Options $options, array $media): string => json_encode($media, \JSON_THROW_ON_ERROR),
        );
    }
}
