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

use Guanguans\Notify\Foundation\Contracts\Authenticator;
use Psr\Http\Message\RequestInterface;

class AggregateAuthenticator implements Authenticator
{
    /**
     * @var array<Authenticator>
     */
    private array $authenticators;

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
}
