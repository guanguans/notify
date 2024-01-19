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

use Guanguans\Notify\Foundation\Contracts\Client;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

abstract class HttpCredential implements Contracts\Credential
{
    abstract public function applyToRequest(RequestInterface $request): RequestInterface;

    public static function name(): ?string
    {
        return 'credential';
    }

    public function applyToClient(Client $client): Client
    {
        assert($client instanceof HttpClient);

        return $client->pushMiddleware(
            Middleware::mapRequest(function (RequestInterface $request): RequestInterface {
                return $this->applyToRequest($request);
            }),
            static::name()
        );
    }
}
