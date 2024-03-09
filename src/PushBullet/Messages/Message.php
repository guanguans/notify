<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
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
