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

use Guanguans\Notify\Foundation\Contracts\Credential;
use Psr\Http\Message\RequestInterface;

class AggregateCredential implements Credential
{
    /**
     * @var array<Credential>
     */
    private array $credentials;

    public function __construct(Credential ...$credential)
    {
        $this->credentials = $credential;
    }

    public function applyToOptions(array $options): array
    {
        return array_reduce(
            $this->credentials,
            static fn (array $carry, Credential $credential): array => $credential->applyToOptions($carry),
            $options,
        );
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return array_reduce(
            $this->credentials,
            static fn (RequestInterface $request, Credential $credential): RequestInterface => $credential->applyToRequest($request),
            $request,
        );
    }
}
