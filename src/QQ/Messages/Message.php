<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\QQ\Messages;

use Guanguans\Notify\Foundation\Concerns\AsMultipart;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self channelId($channelId)
 * @method self content($content)
 * @method self embed(array $embed)
 * @method self ark(array $ark)
 * @method self messageReference(array $messageReference)
 * @method self image($image)
 * @method self fileImage($fileImage)
 * @method self msgId($msgId)
 * @method self eventId($eventId)
 * @method self markdown(array $markdown)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsMultipart;
    use AsPost;

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
