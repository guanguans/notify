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

use Guanguans\Notify\Foundation\Message;
use GuzzleHttp\RequestOptions;

/**
 * @mixin Message
 */
trait AsJson
{
    public function toHttpOptions(): array
    {
        return [
            RequestOptions::JSON => $this->getOptions(),
        ];
    }
}
