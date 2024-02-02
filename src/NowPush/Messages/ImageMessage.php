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

/**
 * @method \Guanguans\Notify\NowPush\Messages\ImageMessage messageType($messageType)
 * @method \Guanguans\Notify\NowPush\Messages\ImageMessage note($note)
 * @method \Guanguans\Notify\NowPush\Messages\ImageMessage deviceType($deviceType)
 * @method \Guanguans\Notify\NowPush\Messages\ImageMessage url($url)
 */
class ImageMessage extends Message
{
    protected array $defined = [
        'message_type',
        'note',
        'device_type',
        'url',
    ];

    protected array $options = [
        'device_type' => 'api',
    ];

    protected array $defaults = [
        'message_type' => 'nowpush_img',
    ];
}
