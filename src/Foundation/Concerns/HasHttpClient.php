<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
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
use Psr\Http\Message\ResponseInterface;
use function Guanguans\Notify\Foundation\Support\tap;

/**
 * @method static setHandler(callable $handler)
 * @method static unshift(callable $middleware, string $name = null)
 * @method static push(callable $middleware, string $name = '')
 * @method static before(string $findName, callable $middleware, string $withName = '')
 * @method static after(string $findName, callable $middleware, string $withName = '')
 * @method static remove($remove)
 * @method static allowRedirects($allowRedirects)
 * @method static auth($auth)
 * @method static baseUri($baseUri)
 * @method static body($body)
 * @method static cert($cert)
 * @method static connectTimeout($connectTimeout)
 * @method static cookies($cookies)
 * @method static cryptoMethod($cryptoMethod)
 * @method static curl($curl)
 * @method static debug($debug)
 * @method static decodeContent($decodeContent)
 * @method static delay($delay)
 * @method static expect($expect)
 * @method static forceIpResolve($forceIpResolve)
 * @method static formParams($formParams)
 * @method static headers($headers)
 * @method static httpErrors($httpErrors)
 * @method static idnConversion($idnConversion)
 * @method static json($json)
 * @method static multipart($multipart)
 * @method static onHeaders($onHeaders)
 * @method static onStats($onStats)
 * @method static progress($progress)
 * @method static proxy($proxy)
 * @method static query($query)
 * @method static readTimeout($readTimeout)
 * @method static sink($sink)
 * @method static sslKey($sslKey)
 * @method static stream($stream)
 * @method static synchronous($synchronous)
 * @method static timeout($timeout)
 * @method static verify($verify)
 * @method static version($version)
 *
 * @see \GuzzleHttp\HandlerStack
 * @see \GuzzleHttp\RequestOptions
 *
 * @mixin \Guanguans\Notify\Foundation\Client
 */
trait HasHttpClient
{
    private ?Client $httpClient = null;

    /** @var null|callable(static): \GuzzleHttp\Client */
    private $httpClientResolver;
    private ?HandlerStack $handlerStack = null;

    /** @var null|callable(static): \GuzzleHttp\HandlerStack */
    private $handlerStackResolver;
    private array $httpOptions = [];

    public function __call(string $name, array $arguments): self
    {
        if (method_exists($this->getHandlerStack(), $name)) {
            $this->getHandlerStack()->{$name}(...$arguments);

            return $this;
        }

        if (\in_array($snakedName = Str::snake($name), Utils::httpOptionConstants(), true)) {
            if ([] === $arguments) {
                throw new InvalidArgumentException(
                    \sprintf('The method [%s::%s] require an argument.', static::class, $name),
                );
            }

            return $this->setHttpOptions([$snakedName => $arguments[0]]);
        }

        throw new BadMethodCallException(\sprintf('The method [%s::%s] does not exist.', static::class, $name));
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

    /**
     * @param callable(static): \GuzzleHttp\Client $httpClientResolver
     */
    public function setHttpClientResolver(callable $httpClientResolver): self
    {
        $this->httpClientResolver = $httpClientResolver;

        return $this;
    }

    /**
     * @return callable(static): \GuzzleHttp\Client
     */
    public function getHttpClientResolver(): callable
    {
        return $this->httpClientResolver ??= fn (): Client => new Client($this->allNormalizedHttpOptions());
    }

    public function setHandlerStack(HandlerStack $handlerStack): self
    {
        $this->handlerStack = $handlerStack;

        return $this;
    }

    public function getHandlerStack(): HandlerStack
    {
        return $this->handlerStack ??= $this->getHandlerStackResolver()($this);
    }

    /**
     * @param callable(static): \GuzzleHttp\HandlerStack $handlerStackResolver
     */
    public function setHandlerStackResolver(callable $handlerStackResolver): self
    {
        $this->handlerStackResolver = $handlerStackResolver;

        return $this;
    }

    /**
     * @return callable(static): \GuzzleHttp\HandlerStack
     */
    public function getHandlerStackResolver(): callable
    {
        return $this->handlerStackResolver ??= fn (): HandlerStack => tap(
            HandlerStack::create(),
            function (HandlerStack $handlerStack): void {
                foreach ($this->defaultMiddlewares() as $name => $middleware) {
                    $handlerStack->push($middleware, $name);
                }
            }
        );
    }

    public function setHttpOptions(array $httpOptions): self
    {
        $this->httpOptions = Utils::mergeHttpOptions($this->httpOptions, $httpOptions);

        return $this;
    }

    public function getHttpOptions(): array
    {
        return $this->httpOptions;
    }

    public function allNormalizedHttpOptions(): array
    {
        return Utils::normalizeHttpOptions(
            Utils::mergeHttpOptions($this->defaultHttpOptions(), $this->getHttpOptions()),
        );
    }

    public function defaultHttpOptions(): array
    {
        return [
            'handler' => $this->getHandlerStack(),
            RequestOptions::CONNECT_TIMEOUT => 10,
            RequestOptions::COOKIES => true,
            RequestOptions::HEADERS => ['User-Agent' => Utils::userAgent()],
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::TIMEOUT => 30,
            RequestOptions::ON_STATS => static function (TransferStats $transferStats): void {
                Response::setTransferStats($transferStats);
            },
        ];
    }

    /**
     * @return array<string, callable(callable): callable>
     */
    public function defaultMiddlewares(): array
    {
        return [
            Authenticate::class => new Authenticate($this->authenticator),
            Response::class => new Response,
        ];
    }

    /**
     * @param null|list<ResponseInterface|\Throwable> $queue
     */
    public function mock(?array $queue = null, ?callable $onFulfilled = null, ?callable $onRejected = null): self
    {
        $this->setHandler(new MockHandler($queue, $onFulfilled, $onRejected));

        return $this;
    }
}
