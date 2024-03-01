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
use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self channel($channel)
 * @method self attachments(array $attachments)
 * @method self blocks(array $blocks)
 * @method self text($text)
 * @method self asUser(bool $asUser)
 * @method self iconEmoji($iconEmoji)
 * @method self iconUrl($iconUrl)
 * @method self linkNames(bool $linkNames)
 * @method self metadata($metadata)
 * @method self mrkdwn(bool $mrkdwn)
 * @method self parse($parse)
 * @method self replyBroadcast(bool $replyBroadcast)
 * @method self threadTs($threadTs)
 * @method self unfurlLinks(bool $unfurlLinks)
 * @method self unfurlMedia(bool $unfurlMedia)
 * @method self username($username)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsNullUri;
    use AsPost;

    protected array $defined = [
        'channel',
        'attachments',
        'blocks',
        'text',
        'as_user',
        'icon_emoji',
        'icon_url',
        'link_names',
        'metadata',
        'mrkdwn',
        'parse',
        'reply_broadcast',
        'thread_ts',
        'unfurl_links',
        'unfurl_media',
        'username',
    ];

    protected array $options = [
        'attachments' => [],
        'blocks' => [],
    ];

    protected array $allowedTypes = [
        'attachments' => 'array',
        'blocks' => 'array',
        'as_user' => 'bool',
        'link_names' => 'bool',
        'mrkdwn' => 'bool',
        'reply_broadcast' => 'bool',
        'unfurl_links' => 'bool',
        'unfurl_media' => 'bool',
    ];

    public function addAttachment(array $attachment): self
    {
        $this->options['attachments'][] = $this->configureAndResolveOptions(
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

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void {}
}
