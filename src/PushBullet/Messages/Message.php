<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\PushBullet\Messages;

use Guanguans\Notify\Foundation\AbstractMessage;

/**
 * @method self body(mixed $body)
 * @method self channelTag(mixed $channelTag)
 * @method self clientIden(mixed $clientIden)
 * @method self deviceIden(mixed $deviceIden)
 * @method self email(mixed $email)
 * @method self fileName(mixed $fileName)
 * @method self fileType(mixed $fileType)
 * @method self fileUrl(mixed $fileUrl)
 * @method self guid(mixed $guid)
 * @method self sourceDeviceIden(mixed $sourceDeviceIden)
 * @method self title(mixed $title)
 * @method self type(mixed $type)
 * @method self url(mixed $url)
 */
class Message extends AbstractMessage
{
    /** @var list<string> */
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

    /** @var array<string, mixed> */
    protected array $allowedValues = [
        // 'type' => ['note', 'link', 'file'],
    ];

    public function toHttpUri(): string
    {
        return 'v2/pushes';
    }
}
