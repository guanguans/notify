<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Slack\Messages;

use Guanguans\Notify\Foundation\AbstractMessage;
use Guanguans\Notify\Foundation\Concerns\AsNullUri;

/**
 * @method self asUser(bool $asUser)
 * @method self attachments(array $attachments)
 * @method self blocks(array $blocks)
 * @method self channel(mixed $channel)
 * @method self iconEmoji(mixed $iconEmoji)
 * @method self iconUrl(mixed $iconUrl)
 * @method self linkNames(bool $linkNames)
 * @method self metadata(array $metadata)
 * @method self mrkdwn(bool $mrkdwn)
 * @method self parse(mixed $parse)
 * @method self replyBroadcast(bool $replyBroadcast)
 * @method self text(mixed $text)
 * @method self threadTs(mixed $threadTs)
 * @method self unfurlLinks(bool $unfurlLinks)
 * @method self unfurlMedia(bool $unfurlMedia)
 * @method self username(mixed $username)
 */
class Message extends AbstractMessage
{
    use AsNullUri;

    /** @var list<string> */
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

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'attachments' => 'array[]',
        'blocks' => 'array[]',
        'as_user' => 'bool',
        'link_names' => 'bool',
        'metadata' => 'array',
        'mrkdwn' => 'bool',
        'reply_broadcast' => 'bool',
        'unfurl_links' => 'bool',
        'unfurl_media' => 'bool',
    ];

    /** @var array<string, mixed> */
    protected array $options = [
        'attachments' => [],
        'blocks' => [],
    ];

    /**
     * @api
     *
     * @param array<array-key, mixed> $attachment
     */
    public function addAttachment(array $attachment): self
    {
        $this->options['attachments'][] = $attachment;

        return $this;
    }

    /**
     * @api
     *
     * @param array<array-key, mixed> $block
     */
    public function addBlock(array $block): self
    {
        $this->options['blocks'][] = $block;

        return $this;
    }
}
