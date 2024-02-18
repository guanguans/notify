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

use GuzzleHttp\Middleware;
use Psr\Http\Message\ResponseInterface;

class Response
{
    public function __invoke(callable $handler): callable
    {
        return Middleware::mapResponse(
            static fn (
                ResponseInterface $response
            ): ResponseInterface => \Guanguans\Notify\Foundation\Response::createFromPsrResponse($response)
        )($handler);
    }
}
