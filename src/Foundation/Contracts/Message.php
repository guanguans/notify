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

use Psr\Http\Message\UriInterface;

interface Message extends \ArrayAccess
{
    public function httpMethod(): string;

    /**
     * @return string|UriInterface
     */
    public function httpUri();

    public function toHttpOptions(): array;
}
