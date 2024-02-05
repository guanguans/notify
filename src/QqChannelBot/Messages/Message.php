<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\QqChannelBot\Messages;

use Guanguans\Notify\Foundation\Concerns\AsPost;
use GuzzleHttp\RequestOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @see https://bot.q.qq.com/wiki/develop/api/openapi/message/post_messages.html#%E5%8F%82%E6%95%B0
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;

    protected array $defined = [
        'is_sandbox',
        'channel_id',

        'content',
        'image',
        'file_image',
        'msg_id',
        'event_id',
        'embed',
        'ark',
        'message_reference',
        'markdown',
    ];

    protected array $allowedTypes = [
        'embed' => 'array',
        'ark' => 'array',
        'message_reference' => 'array',
        'markdown' => 'array',
    ];

    protected array $options = [
        'is_sandbox' => false,
    ];

    public function toHttpOptions(): array
    {
        $options = $this->getOptions();

        unset($options['is_sandbox'], $options['channel_id']);

        return [
            RequestOptions::MULTIPART => to_multipart($options),
        ];
    }

    public function setEmbed(array $embed): self
    {
        $this->options['embed'] = configure_options($embed, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    'title',
                    'prompt',
                    'thumbnail',
                    'fields',
                ]);
        });

        return $this;
    }

    public function setArk(array $ark): self
    {
        $this->options['ark'] = configure_options($ark, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    'template_id',
                    'kv',
                ]);
        });

        return $this;
    }

    public function setMessageReference(array $messageReference): self
    {
        $this->options['message_reference'] = configure_options(
            $messageReference,
            static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'template_id',
                        'ignore_get_message_error',
                    ]);
            }
        );

        return $this;
    }

    public function setMarkdown(array $markdown): self
    {
        $this->options['markdown'] = configure_options(
            $markdown,
            static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'template_id',
                        'params',
                        'content',
                    ]);
            }
        );

        return $this;
    }

    public function toHttpUri(): string
    {
        return $this->getOption('is_sandbox')
            ? "https://sandbox.api.sgroup.qq.com/channels/{$this->getOption('channel_id')}/messages"
            : "https://api.sgroup.qq.com/channels/{$this->getOption('channel_id')}/messages";
    }
}
