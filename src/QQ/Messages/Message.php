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

namespace Guanguans\Notify\QQ\Messages;

use Guanguans\Notify\Foundation\Concerns\AsMultipart;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self ark(array $ark)
 * @method self channelId(mixed $channelId)
 * @method self content(mixed $content)
 * @method self embed(array $embed)
 * @method self eventId(mixed $eventId)
 * @method self fileImage(mixed $fileImage)
 * @method self image(mixed $image)
 * @method self markdown(array $markdown)
 * @method self messageReference(array $messageReference)
 * @method self msgId(mixed $msgId)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsMultipart;

    /** @var list<string> */
    protected array $defined = [
        'channel_id',
        'content',
        'embed',
        'ark',
        'message_reference',
        'image',
        'file_image',
        'msg_id',
        'event_id',
        'markdown',
    ];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'embed' => 'array',
        'ark' => 'array',
        'message_reference' => 'array',
        'markdown' => 'array',
    ];

    public function toHttpUri(): string
    {
        return "channels/{$this->getOption('channel_id')}/messages";
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver
            ->setDefault('embed', static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'title',
                        'prompt',
                        'thumbnail',
                        'fields',
                    ])
                    ->setAllowedTypes('thumbnail', 'array')
                    ->setAllowedTypes('fields', 'array')
                    ->setDefault('thumbnail', static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver->setDefined([
                            'url',
                        ]);
                    })
                    ->setDefault('fields', static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver
                            ->setPrototype(true)
                            ->setDefined([
                                'name',
                            ]);
                    });
            })
            ->setDefault('ark', static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'template_id',
                        'kv',
                    ])
                    ->setAllowedTypes('kv', 'array')
                    ->setDefault('kv', static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver
                            ->setPrototype(true)
                            ->setDefined([
                                'key',
                                'value',
                                'obj',
                            ])
                            ->setAllowedTypes('obj', 'array')
                            ->setDefault('obj', static function (OptionsResolver $optionsResolver): void {
                                $optionsResolver
                                    ->setPrototype(true)
                                    ->setDefined([
                                        'obj_kv',
                                    ])
                                    ->setAllowedTypes('obj_kv', 'array')
                                    ->setDefault('obj_kv', static function (OptionsResolver $optionsResolver): void {
                                        $optionsResolver
                                            ->setPrototype(true)
                                            ->setDefined([
                                                'key',
                                                'value',
                                            ]);
                                    });
                            });
                    });
            })
            ->setDefault('message_reference', static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'template_id',
                        'ignore_get_message_error',
                    ])
                    ->setAllowedTypes('ignore_get_message_error', 'bool');
            })
            ->setDefault('markdown', static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'template_id',
                        'custom_template_id',
                        'params',
                        'content',
                    ])
                    ->setAllowedTypes('params', 'array')
                    ->setDefault('params', static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver
                            ->setDefined([
                                'key',
                                'values',
                            ])
                            ->setAllowedTypes('values', 'array');
                    });
            });
    }
}
