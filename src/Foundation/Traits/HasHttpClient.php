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

use Guanguans\Notify\Foundation\Middleware\Authenticate;
use Guanguans\Notify\Foundation\Middleware\Response;
use Guanguans\Notify\Foundation\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;

/**
 * @method self setHandler(callable $handler)
 * @method self unshift(callable $middleware, string $name = null)
 * @method self push(callable $middleware, string $name = '')
 * @method self before(string $findName, callable $middleware, string $withName = '')
 * @method self after(string $findName, callable $middleware, string $withName = '')
 * @method self remove($remove)
 * @method self baseUri($baseUri)
 * @method self allowRedirects($allowRedirects)
 * @method self auth($auth)
 * @method self body($body)
 * @method self cert($cert)
 * @method self cookies($cookies)
 * @method self connectTimeout($connectTimeout)
 * @method self cryptoMethod($cryptoMethod)
 * @method self debug($debug)
 * @method self decodeContent($decodeContent)
 * @method self delay($delay)
 * @method self expect($expect)
 * @method self formParams($formParams)
 * @method self headers($headers)
 * @method self httpErrors($httpErrors)
 * @method self idnConversion($idnConversion)
 * @method self json($json)
 * @method self multipart($multipart)
 * @method self onHeaders($onHeaders)
 * @method self onStats($onStats)
 * @method self progress($progress)
 * @method self proxy($proxy)
 * @method self query($query)
 * @method self sink($sink)
 * @method self synchronous($synchronous)
 * @method self sslKey($sslKey)
 * @method self stream($stream)
 * @method self verify($verify)
 * @method self timeout($timeout)
 * @method self readTimeout($readTimeout)
 * @method self version($version)
 * @method self forceIpResolve($forceIpResolve)
 *
 * @see \GuzzleHttp\HandlerStack
 * @see \GuzzleHttp\RequestOptions
 *
 * @mixin \Guanguans\Notify\Foundation\Client
 */
trait HasHttpClient
{
    private ?Client $httpClient = null;

    /**
     * @var null|callable
     */
    private $httpClientResolver;

    private ?HandlerStack $handlerStack = null;

    private array $httpOptions = [];

    public function __call($name, $arguments)
    {
        if (method_exists($this->getHandlerStack(), $name)) {
            $this->getHandlerStack()->{$name}(...$arguments);

            return $this;
        }

        $httpOptions = [
            'BASE_URI' => 'base_uri',
        ] + (new \ReflectionClass(RequestOptions::class))->getConstants();
        if (\in_array($snakedName = Str::snake($name), $httpOptions, true)) {
            if (empty($arguments)) {
                throw new \InvalidArgumentException(
                    sprintf('Method %s::%s requires an argument', static::class, $name)
                );
            }

            return $this->setHttpOptions([$snakedName => $arguments[0]]);
        }

        throw new \BadMethodCallException(sprintf('Method %s::%s does not exist.', static::class, $name));
    }

    public function mock(?array $queue = null, ?callable $onFulfilled = null, ?callable $onRejected = null): self
    {
        $this->setHandler(new MockHandler($queue, $onFulfilled, $onRejected));

        return $this;
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
            $this->httpClientResolver = function (): Client {
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
            $this->handlerStack->push(new Response, Response::class);
        }

        return $this->handlerStack = $this->ensureAuthenticate($this->handlerStack);
    }

    private function getHttpOptions(): array
    {
        return $this->httpOptions;
    }

    private function ensureAuthenticate(HandlerStack $handlerStack): HandlerStack
    {
        try {
            (function (): void {
                \assert($this instanceof HandlerStack);
                $this->findByName(Authenticate::class);
            })->call($handlerStack);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            $handlerStack->push(new Authenticate($this->authenticator), Authenticate::class);
        }

        return $handlerStack;
    }
}
