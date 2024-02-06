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

use Guanguans\Notify\Foundation\Response;
use GuzzleHttp\Middleware;
use Psr\Http\Message\ResponseInterface;

class EnsureResponse
{
    public function __invoke(callable $handler): callable
    {
        return Middleware::mapResponse(
            static fn (ResponseInterface $response): ResponseInterface => Response::createFromPsrResponse($response)
        )($handler);
    }
}
