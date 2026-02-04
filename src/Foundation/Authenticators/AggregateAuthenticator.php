<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Authenticators;

use Guanguans\Notify\Foundation\Contracts\Authenticator;
use Psr\Http\Message\RequestInterface;

class AggregateAuthenticator implements Authenticator
{
    /** @var list<Authenticator> */
    private readonly array $authenticators;

    public function __construct(Authenticator ...$authenticators)
    {
        $this->authenticators = $authenticators;
    }

    public function applyToOptions(array $options): array
    {
        return array_reduce(
            $this->authenticators,
            static fn (array $options, Authenticator $authenticator): array => $authenticator->applyToOptions($options),
            $options,
        );
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return array_reduce(
            $this->authenticators,
            static fn (
                RequestInterface $request,
                Authenticator $authenticator
            ): RequestInterface => $authenticator->applyToRequest($request),
            $request,
        );
    }

    public function applyToMiddleware(callable $handler): callable
    {
        return array_reduce(
            $this->authenticators,
            static fn (callable $handler, Authenticator $authenticator): callable => $authenticator->applyToMiddleware($handler),
            $handler,
        );
    }
}
