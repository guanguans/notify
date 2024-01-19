<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Ntfy;

use Guanguans\Notify\Foundation\Contracts\Credential;
use Psr\Http\Message\RequestInterface;

class AccessTokenCredential implements Credential
{
    private string $accessToken;

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('Authorization', "Bearer $this->accessToken");
    }
}
