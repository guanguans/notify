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
    private string $value;
    private string $name;

    public function __construct(string $value, string $name = 'Authorization')
    {
        $this->value = $value;
        $this->name = $name;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withHeader($this->name, $this->value);
    }
}
