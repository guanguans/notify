<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\WeWorkGroupBot\Messages;

use GuzzleHttp\RequestOptions;

/**
 * @method self image($image)
 */
class ImageMessage extends Message
{
    protected array $defined = [
        'image',
    ];

    public function toHttpOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'msgtype' => $this->type(),
                $this->type() => [
                    'base64' => base64_encode_file($this->getOption('image')),
                    'md5' => md5_file($this->getOption('image')),
                ],
            ],
        ];
    }

    protected function type(): string
    {
        return 'image';
    }
}
