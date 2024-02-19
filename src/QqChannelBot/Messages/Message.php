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
 * @method \Guanguans\Notify\QqChannelBot\Messages\Message channelId($channelId)
 * @method \Guanguans\Notify\QqChannelBot\Messages\Message content($content)
 * @method \Guanguans\Notify\QqChannelBot\Messages\Message image($image)
 * @method \Guanguans\Notify\QqChannelBot\Messages\Message fileImage($fileImage)
 * @method \Guanguans\Notify\QqChannelBot\Messages\Message msgId($msgId)
 * @method \Guanguans\Notify\QqChannelBot\Messages\Message eventId($eventId)
 * @method \Guanguans\Notify\QqChannelBot\Messages\Message embed(array $embed)
 * @method \Guanguans\Notify\QqChannelBot\Messages\Message ark(array $ark)
 * @method \Guanguans\Notify\QqChannelBot\Messages\Message messageReference(array $messageReference)
 * @method \Guanguans\Notify\QqChannelBot\Messages\Message markdown(array $markdown)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;

    protected array $defined = [
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

    protected array $options = [];

    public function toHttpOptions(): array
    {
        $options = $this->resolveOptions();

        unset($options['channel_id']);

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
        return "https://api.sgroup.qq.com/channels/{$this->getOption('channel_id')}/messages";
    }
}
