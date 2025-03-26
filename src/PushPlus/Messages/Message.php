<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\PushPlus\Messages;

/**
 * @method self callbackUrl(mixed $callbackUrl)
 * @method self channel(mixed $channel)
 * @method self content(mixed $content)
 * @method self template(mixed $template)
 * @method self timestamp(mixed $timestamp)
 * @method self title(mixed $title)
 * @method self to(mixed $to)
 * @method self topic(mixed $topic)
 * @method self webhook(mixed $webhook)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $required = [
        // 'content',
    ];
    protected array $defined = [
        'topic', // 群组消息
        'to', // 好友消息

        'title',
        'content',
        'template',
        'channel',
        'webhook',
        'callbackUrl',
        'timestamp',
    ];

    public function toHttpUri(): string
    {
        return 'send/{token}';
    }
}
