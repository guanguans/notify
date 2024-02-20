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
 * @method \Guanguans\Notify\Discord\Messages\Message embeds(array $embeds)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

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
                    ->setNormalizer('color', static fn (
                        OptionsResolver $optionsResolver,
                        $value
                    ) => \is_int($value) ? $value : hexdec($value));
            }
        );

        return $this;
    }

    public function toHttpUri(): string
    {
        return '';
    }
}
