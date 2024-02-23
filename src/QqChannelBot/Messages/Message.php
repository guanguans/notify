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
use Guanguans\Notify\Foundation\Support\Utils;
use GuzzleHttp\RequestOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self channelId($channelId)
 * @method self content($content)
 * @method self image($image)
 * @method self fileImage($fileImage)
 * @method self msgId($msgId)
 * @method self eventId($eventId)
 * @method self embed(array $embed)
 * @method self ark(array $ark)
 * @method self messageReference(array $messageReference)
 * @method self markdown(array $markdown)
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
        $options = $this->getOptions();

        unset($options['channel_id']);

        return [
            RequestOptions::MULTIPART => Utils::multipartFor($options),
        ];
    }

    public function setEmbed(array $embed): self
    {
        $this->options['embed'] = $this->configureAndResolveOptions($embed, static function (OptionsResolver $optionsResolver): void {
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
        $this->options['ark'] = $this->configureAndResolveOptions($ark, static function (OptionsResolver $optionsResolver): void {
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
        $this->options['message_reference'] = $this->configureAndResolveOptions(
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
        $this->options['markdown'] = $this->configureAndResolveOptions(
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
