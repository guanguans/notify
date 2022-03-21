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

class SlackMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'text',
        'channel',
        'username',
        'icon_emoji',
        'icon_url',
        'unfurl_links',
        'attachments',
    ];

    protected $options = [
        'unfurl_links' => false,
        'attachments' => [],
    ];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'unfurl_links' => 'bool',
        'attachments' => 'array',
    ];

    public function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($resolver), function ($resolver) {
            $resolver->setNormalizer('attachments', function (Options $options, $value) {
                return isset($value[0]) ? $value : [$value];
            });
        });
    }

    public function setAttachments(array $attachments)
    {
        return $this->addAttachments($attachments);
    }

    public function addAttachments(array $attachments)
    {
        foreach ($attachments as $attachment) {
            $this->addAttachment($attachment);
        }

        return $this;
    }

    public function setAttachment(array $attachment)
    {
        return $this->addAttachment($attachment);
    }

    public function addAttachment(array $attachment)
    {
        $this->options['attachments'][] = configure_options($attachment, function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'fallback',
                'text',
                'pretext',
                'color',
                'fields',
            ]);
        });

        return $this;
    }
}
