<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation;

use Psr\Http\Message\UriInterface;

abstract class HttpMessage extends Message
{
    abstract public function httpAsync(): bool;

    abstract public function httpMethod(): string;

    /**
     * @return string|UriInterface
     */
    abstract public function httpUri();

    abstract public function httpOptions(): array;

    /**
     * @return array|mixed
     */
    public function toPayload()
    {
        return $this->options;
    }
}
