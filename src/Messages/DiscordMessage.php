<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscordMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'username',
        'avatar_url',
        'content',
        'tts',
        'embeds',
    ];

    /**
     * @var array<string, mixed[]>
     */
    protected $options = [
        'embeds' => [],
    ];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'tts' => 'bool',
        'embeds' => 'array',
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $resolver): void {
            $resolver->setNormalizer('embeds', static function (OptionsResolver $optionsResolver, array $value): array {
                return isset($value[0]) ? $value : [$value];
            });
        });
    }

    public function setEmbeds(array $embeds): self
    {
        return $this->addEmbeds($embeds);
    }

    public function addEmbeds(array $embeds): self
    {
        foreach ($embeds as $embed) {
            $this->addEmbed($embed);
        }

        return $this;
    }

    public function setEmbed(array $embed): self
    {
        return $this->addEmbed($embed);
    }

    public function addEmbed(array $embed): self
    {
        $this->options['embeds'][] = configure_options($embed, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    'title',
                    'type',
                    'description',
                    'url',
                    'color',
                    'timestamp',
                    'footer',
                    'image',
                    'thumbnail',
                    'author',
                    'fields',
                ])
                ->setAllowedTypes('footer', 'array')
                ->setAllowedTypes('image', 'array')
                ->setAllowedTypes('thumbnail', 'array')
                ->setAllowedTypes('author', 'array')
                ->setAllowedTypes('fields', 'array')
                ->setNormalizer('color', static function (OptionsResolver $optionsResolver, $value) {
                    return is_int($value) ? $value : hexdec($value);
                });
        });

        return $this;
    }
}
