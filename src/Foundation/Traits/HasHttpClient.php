<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Traits;

use Guanguans\Notify\Foundation\Middleware\ApplyCredentialToRequest;
use GuzzleHttp\Client;

/**
 * @mixin \Guanguans\Notify\Foundation\Client
 */
trait HasHttpClient
{
    use HasHandlerStack;

    private array $httpOptions = [];
    private Client $httpClient;
    /** @var (callable(self): Client)|null */
    private $httpClientResolver;

    private function getHttpOptions(): array
    {
        return $this->httpOptions;
    }

    public function setHttpOptions(array $httpOptions): self
    {
        $this->httpOptions = array_merge($this->httpOptions, $httpOptions);

        return $this;
    }

    private function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    public function setHttpClient(Client $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    private function getHttpClientResolver(): callable
    {
        return $this->httpClientResolver ?: function () {
            if (! $this->httpClient instanceof Client) {
                $this->handlerStack->push(
                    new ApplyCredentialToRequest($this->credential),
                    ApplyCredentialToRequest::name()
                );

                $this->setHttpOptions([
                    'handler' => $this->handlerStack,
                ]);

                $this->httpClient = new Client($this->httpOptions);
            }

            return $this->httpClient;
        };
    }

    public function setHttpClientResolver(callable $httpClientResolver): self
    {
        $this->httpClientResolver = $httpClientResolver;

        return $this;
    }
}
