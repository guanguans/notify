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

class RocketChatMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'alias',
        'emoji',
        'text',
        'attachments',
    ];

    /**
     * @var string|array[]
     */
    protected $allowedTypes = [
        'attachments' => ['array'],
    ];

    /**
     * @var array
     */
    protected $options = [
        'attachments' => [],
    ];

    public function __construct(array $options = [])
    {
        parent::__construct($options);

        $this->addAttachments($options['attachments'] ?? []);
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
                'title',
                'title_link',
                'text',
                'image_url',
                'color',
            ]);
        });

        return $this;
    }
}
