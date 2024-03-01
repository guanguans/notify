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
 * @method self roomId($roomId)
 * @method self channel($channel)
 * @method self text($text)
 * @method self alias($alias)
 * @method self emoji($emoji)
 * @method self avatar($avatar)
 * @method self attachments(array $attachments)
 * @method self tmid($tmid)
 * @method self tshow(bool $tshow)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsNullUri;
    use AsPost;

    protected array $defined = [
        'roomId',
        'channel',
        'text',
        'alias',
        'emoji',
        'avatar',
        'attachments',
        'tmid',
        'tshow',
    ];

    protected $allowedTypes = [
        'attachments' => 'array',
        'tshow' => 'bool',
    ];

    protected array $options = [
        'attachments' => [],
    ];

    public function addAttachment(array $attachment): self
    {
        $this->options['attachments'][] = $this->configureAndResolveOptions(
            $attachment,
            static function (OptionsResolver $optionsResolver): void {
                $optionsResolver
                    ->setDefined([
                        'color',
                        'text',
                        'ts',
                        'thumb_url',
                        'message_link',
                        'collapsed',
                        'author_name',
                        'author_link',
                        'author_icon',
                        'title',
                        'title_link',
                        'title_link_download',
                        'image_url',
                        'audio_url',
                        'video_url',
                        'fields',
                    ])
                    ->setAllowedTypes('collapsed', 'bool')
                    ->setAllowedTypes('title_link_download', 'bool')
                    ->setAllowedTypes('fields', 'array');
            }
        );

        return $this;
    }
}
