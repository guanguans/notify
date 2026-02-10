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

namespace Guanguans\Notify\Discord\Messages;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Guanguans\Notify\Foundation\Support\Utils;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self allowedMentions(array $allowedMentions)
 * @method self attachments(array $attachments)
 * @method self avatarUrl(mixed $avatarUrl)
 * @method self components(array $components)
 * @method self content(mixed $content)
 * @method self embeds(array $embeds)
 * @method self files(array $files)
 * @method self payloadJson(mixed $payloadJson)
 * @method self tts(bool $tts)
 * @method self username(mixed $username)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsNullUri;

    /** @var list<string> */
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

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'tts' => 'bool',
        'embeds' => 'array[]',
        'allowed_mentions' => 'array',
        'components' => 'array',
        'files' => 'array',
        'attachments' => 'array',
    ];

    /** @var array<string, mixed> */
    protected array $options = [
        'embeds' => [],
    ];

    /**
     * @api
     *
     * @param array<array-key, mixed> $embed
     */
    public function addEmbed(array $embed): self
    {
        $this->options['embeds'][] = $embed;

        return $this;
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->{Utils::methodNameOfSetDefault()}('embeds', static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setPrototype(true)
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
                    OptionsResolver $_,
                    int|string $value
                ): float|int => \is_int($value) ? $value : hexdec($value))
                ->setAllowedTypes('footer', 'array')
                ->{Utils::methodNameOfSetDefault()}('footer', static function (OptionsResolver $optionsResolver): void {
                    $optionsResolver->setDefined([
                        'text',
                        'icon_url',
                        'proxy_icon_url',
                    ]);
                })
                ->setAllowedTypes('image', 'array')
                ->{Utils::methodNameOfSetDefault()}('image', static function (OptionsResolver $optionsResolver): void {
                    $optionsResolver->setDefined([
                        'url',
                        'proxy_url',
                        'height',
                        'width',
                    ]);
                })
                ->setAllowedTypes('thumbnail', 'array')
                ->{Utils::methodNameOfSetDefault()}('thumbnail', static function (OptionsResolver $optionsResolver): void {
                    $optionsResolver->setDefined([
                        'url',
                        'proxy_url',
                        'height',
                        'width',
                    ]);
                })
                ->setAllowedTypes('video', 'array')
                ->{Utils::methodNameOfSetDefault()}('video', static function (OptionsResolver $optionsResolver): void {
                    $optionsResolver->setDefined([
                        'url',
                        'proxy_url',
                        'height',
                        'width',
                    ]);
                })
                ->setAllowedTypes('provider', 'array')
                ->{Utils::methodNameOfSetDefault()}('provider', static function (OptionsResolver $optionsResolver): void {
                    $optionsResolver->setDefined([
                        'name',
                        'url',
                    ]);
                })
                ->setAllowedTypes('author', 'array')
                ->{Utils::methodNameOfSetDefault()}('author', static function (OptionsResolver $optionsResolver): void {
                    $optionsResolver->setDefined([
                        'name',
                        'url',
                        'icon_url',
                        'proxy_icon_url',
                    ]);
                })
                ->setAllowedTypes('fields', 'array')
                ->{Utils::methodNameOfSetDefault()}('fields', static function (OptionsResolver $optionsResolver): void {
                    $optionsResolver
                        ->setPrototype(true)
                        ->setDefined([
                            'name',
                            'value',
                            'inline',
                        ])
                        ->setAllowedTypes('inline', 'bool');
                });
        });
    }
}
