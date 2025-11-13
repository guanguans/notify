<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\ZohoCliq\Messages;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self bot(array $bot)
 * @method self buttons(array $buttons)
 * @method self card(array $card)
 * @method self slides(array $slides)
 * @method self styles(array $styles)
 * @method self text(mixed $text)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsNullUri;
    protected array $required = [
        // 'text',
    ];
    protected array $defined = [
        'text',
        'bot',
        'card',
        'styles',
        'slides',
        'buttons',
    ];
    protected array $allowedTypes = [
        'bot' => 'array',
        'card' => 'array',
        'styles' => 'array',
        'slides' => 'array[]',
        'buttons' => 'array[]',
    ];
    protected array $options = [
        'slides' => [],
        'buttons' => [],
    ];

    public function addSlide(array $slide): self
    {
        $this->options['slides'][] = $slide;

        return $this;
    }

    public function addButton(array $button): self
    {
        $this->options['buttons'][] = $button;

        return $this;
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver
            ->setDefault('bot', static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'name',
                        'image',
                    ]);
            })
            ->setDefault('card', static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'title',
                        'theme',
                        'thumbnail',
                        'icon',
                        'preview',
                    ]);
            })
            ->setDefault('styles', static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'highlight',
                    ])
                    ->setAllowedTypes('highlight', 'bool');
            })
            ->setDefault('slides', static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setPrototype(true)
                    ->setDefined([
                        'type',
                        'title',
                        'data',
                    ]);
            })
            ->setDefault('buttons', static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setPrototype(true)
                    ->setDefined([
                        'label',
                        'hint',
                        'key',
                        'type',
                        'action',
                    ]);
            });
    }
}
