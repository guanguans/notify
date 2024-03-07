<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Concerns;

use Guanguans\Notify\Foundation\Exceptions\BadMethodCallException;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Foundation\Middleware\Authenticate;
use Guanguans\Notify\Foundation\Middleware\Response;
use Guanguans\Notify\Foundation\Support\Str;
use Guanguans\Notify\Foundation\Support\Utils;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\TransferStats;

/**
 * @method self setHandler(callable $handler)
 * @method self unshift(callable $middleware, string $name = null)
 * @method self push(callable $middleware, string $name = '')
 * @method self before(string $findName, callable $middleware, string $withName = '')
 * @method self after(string $findName, callable $middleware, string $withName = '')
 * @method self remove($remove)
 * @method self allowRedirects($allowRedirects)
 * @method self auth($auth)
 * @method self baseUri($baseUri)
 * @method self body($body)
 * @method self cert($cert)
 * @method self connectTimeout($connectTimeout)
 * @method self cookies($cookies)
 * @method self cryptoMethod($cryptoMethod)
 * @method self curl($curl)
 * @method self debug($debug)
 * @method self decodeContent($decodeContent)
 * @method self delay($delay)
 * @method self expect($expect)
 * @method self forceIpResolve($forceIpResolve)
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
 * @method self readTimeout($readTimeout)
 * @method self sink($sink)
 * @method self sslKey($sslKey)
 * @method self stream($stream)
 * @method self synchronous($synchronous)
 * @method self timeout($timeout)
 * @method self verify($verify)
 * @method self version($version)
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

        if (\in_array($snakedName = Str::snake($name), Utils::getHttpOptionsConstants(), true)) {
            if (empty($arguments)) {
                throw new InvalidArgumentException(
                    sprintf('The method [%s::%s] require an argument.', static::class, $name)
                );
            }

            return $this->setHttpOptions([$snakedName => $arguments[0]]);
        }

        throw new BadMethodCallException(sprintf('The method [%s::%s] does not exist.', static::class, $name));
    }

    public function setHttpClient(Client $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function getHttpClient(): Client
    {
        return $this->httpClient ??= $this->getHttpClientResolver()($this);
    }

    public function setHttpClientResolver(callable $httpClientResolver): self
    {
        $this->httpClientResolver = $httpClientResolver;

        return $this;
    }

    public function getHttpClientResolver(): callable
    {
        return $this->httpClientResolver ??= fn (): Client => new Client($this->getHttpOptions());
    }

    public function setHandlerStack(HandlerStack $handlerStack): self
    {
        $this->handlerStack = $handlerStack;

        return $this;
    }

    public function getHandlerStack(): HandlerStack
    {
        return $this->handlerStack ??= tap(HandlerStack::create(), function (HandlerStack $handlerStack): void {
            $handlerStack->push(new Authenticate($this->authenticator), Authenticate::class);
            $handlerStack->push(new Response, Response::class);
        });
    }

    public function setHttpOptions(array $httpOptions): self
    {
        $this->httpOptions = Utils::mergeHttpOptions($this->httpOptions, $httpOptions);

        return $this;
    }

    public function getHttpOptions(): array
    {
        return $this->httpOptions = Utils::mergeHttpOptions($this->getDefaultHttpOptions(), $this->httpOptions);
    }

    public function getDefaultHttpOptions(): array
    {
        return [
            'handler' => $this->getHandlerStack(),
            RequestOptions::CONNECT_TIMEOUT => 10,
            RequestOptions::COOKIES => true,
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::TIMEOUT => 30,
            RequestOptions::ON_STATS => static function (TransferStats $transferStats): void {
                Response::setTransferStats($transferStats);
            },
        ];
    }

    public function mock(?array $queue = null, ?callable $onFulfilled = null, ?callable $onRejected = null): self
    {
        $this->setHandler(new MockHandler($queue, $onFulfilled, $onRejected));

        return $this;
    }
}
