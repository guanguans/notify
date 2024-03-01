<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Pushover\Messages;

use Guanguans\Notify\Foundation\Concerns\AsMultipart;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method self message($message)
 * @method self attachment($attachment)
 * @method self device($device)
 * @method self html($html)
 * @method self priority($priority)
 * @method self sound($sound)
 * @method self timestamp($timestamp)
 * @method self title($title)
 * @method self ttl($ttl)
 * @method self url($url)
 * @method self urlTitle($urlTitle)
 * @method self retry($retry)
 * @method self expire($expire)
 * @method self monospace($monospace)
 * @method self callback($callback)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsMultipart;
    use AsPost;

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

    protected array $required = [
        // 'token',
        // 'user',
        'message',
    ];

    public function toHttpUri(): string
    {
        return 'https://api.pushover.net/1/messages.json';
    }
}
