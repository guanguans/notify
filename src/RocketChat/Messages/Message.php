<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\RocketChat\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Guanguans\Notify\RocketChat\Messages\Message alias($alias)
 * @method \Guanguans\Notify\RocketChat\Messages\Message emoji($emoji)
 * @method \Guanguans\Notify\RocketChat\Messages\Message text($text)
 * @method \Guanguans\Notify\RocketChat\Messages\Message attachments(array $attachments)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

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

    protected array $options = [
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

    public function httpUri()
    {
        return '{base_uri}/hooks/{token}';
    }
}
