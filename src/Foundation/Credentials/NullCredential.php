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

use Guanguans\Notify\Foundation\Contracts;
use Psr\Http\Message\RequestInterface;

class NullCredential implements Contracts\Credential
{
    public function applyToOptions(array $options): array
    {
        return $options;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request;
    }
}