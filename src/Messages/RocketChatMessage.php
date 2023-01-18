<?php

declare(strict_types=1);

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

    public function setAttachments(array $attachments): self
    {
        return $this->addAttachments($attachments);
    }

    public function addAttachments(array $attachments): self
    {
        foreach ($attachments as $attachment) {
            $this->addAttachment($attachment);
        }

        return $this;
    }

    public function setAttachment(array $attachment): self
    {
        return $this->addAttachment($attachment);
    }

    public function addAttachment(array $attachment): self
    {
        $this->options['attachments'][] = configure_options($attachment, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver->setDefined([
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
