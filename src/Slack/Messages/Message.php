<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Slack\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Guanguans\Notify\Slack\Messages\Message text($text)
 * @method \Guanguans\Notify\Slack\Messages\Message channel($channel)
 * @method \Guanguans\Notify\Slack\Messages\Message username($username)
 * @method \Guanguans\Notify\Slack\Messages\Message iconEmoji($iconEmoji)
 * @method \Guanguans\Notify\Slack\Messages\Message iconUrl($iconUrl)
 * @method \Guanguans\Notify\Slack\Messages\Message unfurlLinks($unfurlLinks)
 * @method \Guanguans\Notify\Slack\Messages\Message attachments(array $attachments)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'text',
        'channel',
        'username',
        'icon_emoji',
        'icon_url',
        'unfurl_links',
        'attachments',
    ];

    protected array $options = [
        'unfurl_links' => false,
        'attachments' => [],
    ];

    protected array $allowedTypes = [
        'unfurl_links' => 'bool',
        'attachments' => 'array',
    ];

    public function addAttachment(array $attachment): self
    {
        $this->options['attachments'][] = configure_options(
            $attachment,
            static function (OptionsResolver $optionsResolver): void {
                $optionsResolver->setDefined([
                    'fallback',
                    'text',
                    'pretext',
                    'color',
                    'fields',
                ]);
            }
        );

        return $this;
    }

    public function toHttpUri(): string
    {
        return '';
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setNormalizer('attachments', static fn (
            OptionsResolver $optionsResolver,
            array $value
        ): array => isset($value[0]) ? $value : [$value]);
    }
}
