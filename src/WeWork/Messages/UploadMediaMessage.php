<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\WeWork\Messages;

use Guanguans\Notify\Foundation\Concerns\AsMultipart;

/**
 * @method self media($media)
 * @method self type($type)
 */
class UploadMediaMessage extends \Guanguans\Notify\Foundation\Message
{
    use AsMultipart;

    protected array $defined = [
        'media',
        'type',
    ];

    protected array $allowedValues = [
        // 'type' => ['voice', 'file'],
    ];

    public function toHttpUri(): string
    {
        return "https://qyapi.weixin.qq.com/cgi-bin/webhook/upload_media?key={token}&type={$this->getOption('type')}";
    }
}
