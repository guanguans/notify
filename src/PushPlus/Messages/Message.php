<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\PushPlus\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method self topic($topic)
 * @method self to($to)
 * @method self title($title)
 * @method self content($content)
 * @method self template($template)
 * @method self channel($channel)
 * @method self webhook($webhook)
 * @method self callbackUrl($callbackUrl)
 * @method self timestamp($timestamp)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

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

    protected array $required = [
        'content',
    ];

    public function toHttpUri(): string
    {
        return 'https://www.pushplus.plus/send/{token}';
    }
}
