<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @see https://bot.q.qq.com/wiki/develop/api/openapi/message/post_messages.html#%E5%8F%82%E6%95%B0
 */
class QqChannelBotMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'content',
        'image',
        'msg_id',
        'embed',
        'ark',
        'message_reference',
        'markdown',
    ];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'embed' => 'array',
        'ark' => 'array',
        'message_reference' => 'array',
        'markdown' => 'array',
    ];

    public function setEmbed(array $embed): self
    {
        $this->options['embed'] = configure_options($embed, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    'title',
                    'prompt',
                    'thumbnail',
                    'fields',
                ]);
        });

        return $this;
    }

    public function setArk(array $ark): self
    {
        $this->options['ark'] = configure_options($ark, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    'template_id',
                    'kv',
                ]);
        });

        return $this;
    }

    public function setMessageReference(array $messageReference): self
    {
        $this->options['message_reference'] = configure_options($messageReference, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    'template_id',
                    'ignore_get_message_error',
                ]);
        });

        return $this;
    }

    public function setMarkdown(array $markdown): self
    {
        $this->options['markdown'] = configure_options($markdown, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    'template_id',
                    'params',
                    'content',
                ]);
        });

        return $this;
    }
}
