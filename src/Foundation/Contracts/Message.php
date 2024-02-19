<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Contracts;

interface Message
{
    public function toHttpMethod(): string;

    public function toHttpUri(): string;

    public function toHttpOptions(): array;
}
