<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Authenticators;

use Psr\Http\Message\RequestInterface;

class CallbackAuthenticator extends NullAuthenticator
{
    /**
     * @var callable(array|RequestInterface):array|RequestInterface
     */
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function applyToOptions(array $options): array
    {
        return ($this->callback)($options) ?: $options;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return ($this->callback)($request) ?: $request;
    }
}
