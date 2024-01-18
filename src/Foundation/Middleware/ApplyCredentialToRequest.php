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

use Guanguans\Notify\Foundation\Contracts\Credential;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

class ApplyCredentialToRequest
{
    private Credential $credential;

    public function __construct(Credential $credential)
    {
        $this->credential = $credential;
    }

    public static function name(): string
    {
        return 'credential';
    }

    public function __invoke(callable $handler): callable
    {
        return Middleware::mapRequest(function (RequestInterface $request): RequestInterface {
            return $this->credential->applyToRequest($request);
        })($handler);
    }
}
