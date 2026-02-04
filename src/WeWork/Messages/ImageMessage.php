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

namespace Guanguans\Notify\WeWork\Messages;

use function Guanguans\Notify\Foundation\Support\base64_encode_file;

/**
 * @method self image(mixed $image)
 */
class ImageMessage extends Message
{
    /** @var list<string> */
    protected array $defined = [
        'image',
    ];

    protected function toPayload(): array
    {
        $payload = parent::toPayload();

        return [
            'msgtype' => $payload['msgtype'],
            $this->type() => [
                'base64' => base64_encode_file($image = $payload['image']['image']),
                'md5' => md5_file($image),
            ],
        ];
    }

    protected function type(): string
    {
        return 'image';
    }
}
