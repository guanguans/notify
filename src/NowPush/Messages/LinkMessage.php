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
 * @method \Guanguans\Notify\NowPush\Messages\LinkMessage messageType($messageType)
 * @method \Guanguans\Notify\NowPush\Messages\LinkMessage note($note)
 * @method \Guanguans\Notify\NowPush\Messages\LinkMessage deviceType($deviceType)
 * @method \Guanguans\Notify\NowPush\Messages\LinkMessage url($url)
 */
class LinkMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'message_type',
        'note',
        'device_type',
        'url',
    ];

    /**
     * @var array<string>
     */
    protected array $options = [
        'device_type' => 'api',
    ];

    /**
     * @var array<string>
     */
    protected array $defaults = [
        'message_type' => 'nowpush_link',
    ];

    public function __construct(string $url, string $deviceType = 'api')
    {
        parent::__construct([
            'url' => $url,
            'device_type' => $deviceType,
        ]);
    }
}
