<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Credentials;

use Psr\Http\Message\RequestInterface;

class HeaderCredential extends NullCredential
{
    private array $headers;

    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return array_reduce_with_keys(
            $this->headers,
            static fn (RequestInterface $request, $value, string $header): RequestInterface => $request->withHeader(
                $header,
                $value
            ),
            $request
        );
    }
}
