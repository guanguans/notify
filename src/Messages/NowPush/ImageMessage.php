<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\NowPush;

use Guanguans\Notify\Messages\Message;

class ImageMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'message_type',
        'note',
        'device_type',
        'url',
    ];

    /**
     * @var string[]
     */
    protected $options = [
        'device_type' => 'api',
    ];

    /**
     * @var string[]
     */
    protected $defaults = [
        'message_type' => 'nowpush_img',
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct(string $url, string $deviceType = 'api')
    {
        parent::__construct([
            'url' => $url,
            'device_type' => $deviceType,
        ]);
    }
}
