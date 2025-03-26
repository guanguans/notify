<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\WeWork\Messages;

use Guanguans\Notify\Foundation\Concerns\AsMultipart;
use Guanguans\Notify\Foundation\Message;

/**
 * @method self media(mixed $media)
 * @method self type(mixed $type)
 */
class UploadMediaMessage extends Message
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
        return "cgi-bin/webhook/upload_media?key={token}&type={$this->getOption('type')}";
    }
}
