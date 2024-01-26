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
 * @method \Guanguans\Notify\Discord\Messages\Message username($username)
 * @method \Guanguans\Notify\Discord\Messages\Message avatarUrl($avatarUrl)
 * @method \Guanguans\Notify\Discord\Messages\Message content($content)
 * @method \Guanguans\Notify\Discord\Messages\Message tts($tts)
 * @method \Guanguans\Notify\Discord\Messages\Message embeds($embeds)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

    protected array $defined = [
        'username',
        'avatar_url',
        'content',
        'tts',
        'embeds',
    ];

    protected array $options = [
        'embeds' => [],
    ];

    protected array $allowedTypes = [
        'tts' => 'bool',
        'embeds' => 'array',
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(
            parent::configureOptionsResolver($optionsResolver),
            static function (OptionsResolver $resolver): void {
                $resolver->setNormalizer(
                    'embeds',
                    static function (OptionsResolver $optionsResolver, array $value): array {
                        return isset($value[0]) ? $value : [$value];
                    }
                );
            }
        );
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
        $this->options['embeds'][] = configure_options(
            $embed,
            static function (OptionsResolver $optionsResolver): void {
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
            }
        );

        return $this;
    }

    public function httpUri()
    {
        // TODO: Implement httpUri() method.
    }
}
