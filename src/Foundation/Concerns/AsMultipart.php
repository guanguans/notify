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

namespace Guanguans\Notify\Foundation\Concerns;

use GuzzleHttp\RequestOptions;

/**
 * @mixin \Guanguans\Notify\Foundation\Message
 */
trait AsMultipart
{
    /**
     * @see \Guanguans\Notify\Foundation\Support\Utils::normalizeHttpOptions()
     * @see \Guanguans\Notify\Foundation\Client::send()
     */
    public function toHttpOptions(): array
    {
        return [
            RequestOptions::MULTIPART => $this->toPayload(),
        ];
    }
}
