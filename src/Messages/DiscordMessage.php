<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

use Symfony\Component\OptionsResolver\Options;
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

    public function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($resolver), function ($resolver) {
            $resolver->setNormalizer('embeds', function (Options $options, $value) {
                return isset($value[0]) ? $value : [$value];
            });
        });
    }

    public function setEmbeds(array $embeds)
    {
        return $this->addEmbeds($embeds);
    }

    public function addEmbeds(array $embeds)
    {
        foreach ($embeds as $embed) {
            $this->addEmbed($embed);
        }

        return $this;
    }

    public function setEmbed(array $embed)
    {
        return $this->addEmbed($embed);
    }

    public function addEmbed(array $embed)
    {
        $this->options['embeds'][] = configure_options($embed, function (OptionsResolver $resolver) {
            $resolver
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
                ->setNormalizer('color', function (Options $options, $value) {
                    return is_int($value) ? $value : hexdec($value);
                });
        });

        return $this;
    }
}
