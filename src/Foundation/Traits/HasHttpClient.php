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
use Guanguans\Notify\Foundation\Middleware\EnsureResponse;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

/**
 * @method self setHandler(callable $handler)
 * @method self unshift(callable $middleware, string $name = null)
 * @method self push(callable $middleware, string $name = '')
 * @method self before(string $findName, callable $middleware, string $withName = '')
 * @method self after(string $findName, callable $middleware, string $withName = '')
 * @method self remove($remove)
 * @method \GuzzleHttp\Promise\PromiseInterface sendAsync(\Psr\Http\Message\RequestInterface $request, array $options = [])
 * @method \Psr\Http\Message\ResponseInterface sendRequest(\Psr\Http\Message\RequestInterface $request)
 * @method \GuzzleHttp\Promise\PromiseInterface requestAsync(string $method, $uri = '', array $options = [])
 * @method \Psr\Http\Message\ResponseInterface request(string $method, $uri = '', array $options = [])
 * @method \Psr\Http\Message\ResponseInterface get($uri, array $options = [])
 * @method \Psr\Http\Message\ResponseInterface head($uri, array $options = [])
 * @method \Psr\Http\Message\ResponseInterface put($uri, array $options = [])
 * @method \Psr\Http\Message\ResponseInterface post($uri, array $options = [])
 * @method \Psr\Http\Message\ResponseInterface patch($uri, array $options = [])
 * @method \Psr\Http\Message\ResponseInterface delete($uri, array $options = [])
 * @method \GuzzleHttp\Promise\PromiseInterface getAsync($uri, array $options = [])
 * @method \GuzzleHttp\Promise\PromiseInterface headAsync($uri, array $options = [])
 * @method \GuzzleHttp\Promise\PromiseInterface putAsync($uri, array $options = [])
 * @method \GuzzleHttp\Promise\PromiseInterface postAsync($uri, array $options = [])
 * @method \GuzzleHttp\Promise\PromiseInterface patchAsync($uri, array $options = [])
 * @method \GuzzleHttp\Promise\PromiseInterface deleteAsync($uri, array $options = [])
 *
 * @see \GuzzleHttp\HandlerStack
 * @see \GuzzleHttp\Client
 *
 * @mixin \Guanguans\Notify\Foundation\Client
 */
trait HasHttpClient
{
    private ?Client $httpClient = null;
    private $httpClientResolver;
    private ?HandlerStack $handlerStack = null;
    private array $httpOptions = [];

    /**
     * @noinspection MissingReturnTypeInspection
     * @noinspection MissingParameterTypeDeclarationInspection
     *
     * @param mixed $name
     * @param mixed $arguments
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->getHandlerStack(), $name)) {
            $this->getHandlerStack()->{$name}(...$arguments);

            return $this;
        }

        if (method_exists($this->getHttpClient(), $name)) {
            return $this->getHttpClient()->{$name}(...$arguments);
        }

        throw new \BadMethodCallException(sprintf('Method %s::%s does not exist.', static::class, $name));
    }

    public function setHttpClient(Client $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function setHttpClientResolver(callable $httpClientResolver): self
    {
        $this->httpClientResolver = $httpClientResolver;

        return $this;
    }

    public function setHandlerStack(HandlerStack $handlerStack): self
    {
        $this->handlerStack = $handlerStack;

        return $this;
    }

    public function setHttpOptions(array $httpOptions): self
    {
        $this->httpOptions = array_replace($this->httpOptions, $httpOptions);

        return $this;
    }

    private function getHttpClient(): Client
    {
        return $this->getHttpClientResolver()();
    }

    private function getHttpClientResolver(): callable
    {
        if (! \is_callable($this->httpClientResolver)) {
            $this->httpClientResolver = function () {
                if (! $this->httpClient instanceof Client) {
                    $this->setHttpOptions([
                        'handler' => $this->getHandlerStack(),
                    ]);

                    $this->httpClient = new Client($this->getHttpOptions());
                }

                return $this->httpClient;
            };
        }

        return $this->httpClientResolver;
    }

    private function getHandlerStack(): HandlerStack
    {
        if (! $this->handlerStack instanceof HandlerStack) {
            $this->handlerStack = HandlerStack::create();
            $this->handlerStack->push(new EnsureResponse, EnsureResponse::name());
        }

        return $this->handlerStack = $this->ensureWithApplyCredentialToRequest($this->handlerStack);
    }

    private function getHttpOptions(): array
    {
        return $this->httpOptions;
    }

    private function ensureWithApplyCredentialToRequest(HandlerStack $handlerStack): HandlerStack
    {
        try {
            (function (): void {
                $this->findByName(ApplyCredentialToRequest::name());
            })->call($handlerStack);
        } catch (\InvalidArgumentException $e) {
            $handlerStack->push(
                new ApplyCredentialToRequest($this->credential),
                ApplyCredentialToRequest::name()
            );
        }

        return $handlerStack;
    }
}
