<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Middleware;

use Guanguans\Notify\Foundation\Contracts\Authenticator;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

class Authenticate
{
    private Authenticator $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function __invoke(callable $handler): callable
    {
        return Middleware::mapRequest(
            fn (RequestInterface $request): RequestInterface => $this->authenticator->applyToRequest($request)
        )($handler);
    }
}
