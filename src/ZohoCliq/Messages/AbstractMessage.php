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

namespace Guanguans\Notify\ZohoCliq\Messages;

use Guanguans\Notify\Foundation\Support\Arr;
use Guanguans\Notify\Foundation\Support\Utils;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self bot(array $bot)
 * @method self buttons(array $buttons)
 * @method self card(array $card)
 * @method self postInParent(mixed $postInParent)
 * @method self slides(array $slides)
 * @method self styles(array $styles)
 * @method self text(mixed $text)
 * @method self threadMessageId(mixed $threadMessageId)
 * @method self threadTitle(mixed $threadTitle)
 */
abstract class AbstractMessage extends \Guanguans\Notify\Foundation\Message
{
    /** @var list<string> */
    protected array $required = [
        // 'channel_unique_name',
        // 'bot_unique_name',
        // 'chat_id',
        // 'email_id',
        // 'text',
    ];

    /** @var list<string> */
    protected array $defined = [
        'text',
        'bot',
        'card',
        'styles',
        'slides',
        'buttons',

        // To send message in thread
        'thread_message_id',
        'thread_title',
        'post_in_parent',
    ];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'bot' => 'array',
        'card' => 'array',
        'styles' => 'array',
        'slides' => 'array[]',
        'buttons' => 'array[]',
    ];

    /** @var array<string, mixed> */
    protected array $options = [
        'slides' => [],
        'buttons' => [],
    ];

    /**
     * @api
     *
     * @param array<array-key, mixed> $slide
     */
    final public function addSlide(array $slide): self
    {
        $this->options['slides'][] = $slide;

        return $this;
    }

    /**
     * @api
     *
     * @param array<array-key, mixed> $button
     */
    final public function addButton(array $button): self
    {
        $this->options['buttons'][] = $button;

        return $this;
    }

    protected function toPayload(): array
    {
        return Arr::except(parent::toPayload(), [
            'channel_unique_name',
            'bot_unique_name',
            'chat_id',
            'email_id',
        ]);
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
            ->{Utils::methodNameOfSetDefault()}('styles', static function (OptionsResolver $optionsResolver): void {
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
