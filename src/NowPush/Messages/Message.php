<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\NowPush\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method self messageType($messageType)
 * @method self note($note)
 * @method self deviceType($deviceType)
 * @method self url($url)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'message_type',
        'note',
        'device_type',
        'url',
    ];

    protected array $allowedValues = [
        // 'message_type' => ['nowpush_note', 'nowpush_img', 'nowpush_link'],
        'device_type' => 'api',
    ];

    protected array $options = [
        'device_type' => 'api',
    ];

    public function toHttpUri(): string
    {
        return 'https://www.api.nowpush.app/v3/sendMessage';
    }
}
