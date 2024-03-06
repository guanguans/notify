<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Concerns;

use GuzzleHttp\RequestOptions;

/**
 * @mixin \Guanguans\Notify\Foundation\Message
 */
trait AsBody
{
    public function toHttpOptions(): array
    {
        return [
            // RequestOptions::HEADERS => ['Content-Type' => 'application/json'],
            RequestOptions::BODY => (string) $this,
        ];
    }
}
