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

use Psr\Http\Message\RequestInterface;

class AuthorizationTokenCredential extends NullCredential
{
    private string $token;
    private string $type;

    public function __construct(string $token, string $type = 'Bearer')
    {
        $this->token = $token;
        $this->type = $type;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('Authorization', trim("$this->type $this->token"));
    }
}
