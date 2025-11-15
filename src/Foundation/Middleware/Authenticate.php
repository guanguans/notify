<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Middleware;

use Guanguans\Notify\Foundation\Contracts\Authenticator;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

class Authenticate
{
    public function __construct(private Authenticator $authenticator) {}

    public function __invoke(callable $handler): callable
    {
        return $this->authenticator->applyToMiddleware(
            Middleware::mapRequest(
                fn (RequestInterface $request): RequestInterface => $this->authenticator->applyToRequest($request),
            )($handler)
        );
    }
}
