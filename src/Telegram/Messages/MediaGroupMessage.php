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

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self chatId($chatId)
 * @method self messageThreadId($messageThreadId)
 * @method self media(array $media)
 * @method self disableNotification($disableNotification)
 * @method self protectContent($protectContent)
 * @method self replyParameters($replyParameters)
 */
class MediaGroupMessage extends Message
{
    protected array $defined = [
        'chat_id',
        'message_thread_id',
        'media',
        'disable_notification',
        'protect_content',
        'reply_parameters',
    ];

    protected array $options = [
        'media' => [],
    ];

    protected array $allowedTypes = [
        'media' => 'array',
    ];

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
            static fn (Options $options, array $media): string => json_encode($media, JSON_THROW_ON_ERROR)
        );
    }
}
