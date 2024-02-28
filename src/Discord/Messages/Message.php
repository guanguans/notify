<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Discord\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self content($content)
 * @method self embeds(array $embeds)
 * @method self allowedMentions(array $allowedMentions)
 * @method self components(array $components)
 * @method self files(array $files)
 * @method self payloadJson($payloadJson)
 * @method self attachments(array $attachments)
 * @method self username($username)
 * @method self avatarUrl($avatarUrl)
 * @method self tts($tts)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'content',
        'embeds',
        'allowed_mentions',
        'components',
        'files',
        'payload_json',
        'attachments',

        'username',
        'avatar_url',
        'tts',
    ];

    protected array $options = [
        'embeds' => [],
    ];

    protected array $allowedTypes = [
        'tts' => 'bool',
        'embeds' => 'array',
        'allowed_mentions' => 'array',
        'components' => 'array',
        'files' => 'array',
        'attachments' => 'array',
    ];

    public function addEmbed(array $embed): self
    {
        $this->options['embeds'][] = $this->configureAndResolveOptions(
            $embed,
            static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'title',
                        'type',
                        'description',
                        'url',
                        'timestamp',
                        'color',
                        'footer',
                        'image',
                        'thumbnail',
                        'video',
                        'provider',
                        'author',
                        'fields',
                    ])
                    ->setNormalizer('color', static fn (
                        OptionsResolver $optionsResolver,
                        $value
                    ) => \is_int($value) ? $value : hexdec($value))
                    ->setAllowedTypes('footer', 'array')
                    ->setDefault('footer', static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver->setDefined([
                            'text',
                            'icon_url',
                            'proxy_icon_url',
                        ]);
                    })
                    ->setAllowedTypes('image', 'array')
                    ->setDefault('image', static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver->setDefined([
                            'url',
                            'proxy_url',
                            'height',
                            'width',
                        ]);
                    })
                    ->setAllowedTypes('thumbnail', 'array')
                    ->setDefault('thumbnail', static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver->setDefined([
                            'url',
                            'proxy_url',
                            'height',
                            'width',
                        ]);
                    })
                    ->setAllowedTypes('video', 'array')
                    ->setDefault('video', static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver->setDefined([
                            'url',
                            'proxy_url',
                            'height',
                            'width',
                        ]);
                    })
                    ->setAllowedTypes('provider', 'array')
                    ->setDefault('provider', static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver->setDefined([
                            'name',
                            'url',
                        ]);
                    })
                    ->setAllowedTypes('author', 'array')
                    ->setDefault('author', static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver->setDefined([
                            'name',
                            'url',
                            'icon_url',
                            'proxy_icon_url',
                        ]);
                    })
                    ->setAllowedTypes('fields', 'array');
            }
        );

        return $this;
    }

    public function toHttpUri(): string
    {
        return '';
    }
}
