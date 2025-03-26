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

namespace Guanguans\Notify\Pushover\Messages;

use Guanguans\Notify\Foundation\Concerns\AsMultipart;

/**
 * @method self attachment(mixed $attachment)
 * @method self callback(mixed $callback)
 * @method self device(mixed $device)
 * @method self expire(mixed $expire)
 * @method self html(mixed $html)
 * @method self message(mixed $message)
 * @method self monospace(mixed $monospace)
 * @method self priority(mixed $priority)
 * @method self retry(mixed $retry)
 * @method self sound(mixed $sound)
 * @method self timestamp(mixed $timestamp)
 * @method self title(mixed $title)
 * @method self ttl(mixed $ttl)
 * @method self url(mixed $url)
 * @method self urlTitle(mixed $urlTitle)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsMultipart;
    protected array $required = [
        // // 'token',
        // // 'user',
        // 'message',
    ];
    protected array $defined = [
        // 'token',
        // 'user',
        'message',
        'attachment',
        // 'attachment_base64',
        // 'attachment_type',
        'device',
        'html',
        'priority',
        'sound',
        'timestamp',
        'title',
        'ttl',
        'url',
        'url_title',

        'retry',
        'expire',
        'monospace',
        'callback',
    ];

    public function toHttpUri(): string
    {
        return '1/messages.json';
    }
}
