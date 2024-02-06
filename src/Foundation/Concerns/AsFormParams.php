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
trait AsFormParams
{
    public function toHttpOptions(): array
    {
        return [
            RequestOptions::FORM_PARAMS => $this->resolveOptions(),
        ];
    }
}
