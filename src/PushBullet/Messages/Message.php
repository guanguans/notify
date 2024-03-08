<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\PushBullet\Messages;

/**
 * @method self type($type)
 * @method self title($title)
 * @method self body($body)
 * @method self url($url)
 * @method self fileName($fileName)
 * @method self fileType($fileType)
 * @method self fileUrl($fileUrl)
 * @method self sourceDeviceIden($sourceDeviceIden)
 * @method self deviceIden($deviceIden)
 * @method self clientIden($clientIden)
 * @method self channelTag($channelTag)
 * @method self email($email)
 * @method self guid($guid)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $defined = [
        'type',
        'title',
        'body',
        'url',
        'file_name',
        'file_type',
        'file_url',

        'source_device_iden',
        'device_iden',
        'client_iden',
        'channel_tag',
        'email',
        'guid',
    ];

    protected array $allowedValues = [
        // 'type' => ['note', 'link', 'file'],
    ];

    public function toHttpUri(): string
    {
        return 'v2/pushes';
    }
}
