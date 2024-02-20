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
use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self alias($alias)
 * @method self emoji($emoji)
 * @method self text($text)
 * @method self attachments(array $attachments)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsNullUri;
    use AsPost;

    protected array $defined = [
        'alias',
        'emoji',
        'text',
        'attachments',
    ];

    protected $allowedTypes = [
        'attachments' => ['array'],
    ];

    protected array $options = [
        'attachments' => [],
    ];

    public function addAttachment(array $attachment): self
    {
        $this->options['attachments'][] = $this->configureAndResolveOptions($attachment, static function (OptionsResolver $optionsResolver): void {
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
