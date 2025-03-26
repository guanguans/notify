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
 * @method \Guanguans\Notify\Foundation\Client setHandler(callable $handler)
 * @method \Guanguans\Notify\Foundation\Client unshift(callable $middleware, ?string $name = null)
 * @method \Guanguans\Notify\Foundation\Client push(callable $middleware, string $name = '')
 * @method \Guanguans\Notify\Foundation\Client before(string $findName, callable $middleware, string $withName = '')
 * @method \Guanguans\Notify\Foundation\Client after(string $findName, callable $middleware, string $withName = '')
 * @method \Guanguans\Notify\Foundation\Client remove(mixed $remove)
 * @method \Guanguans\Notify\Foundation\Client allowRedirects(array|bool $allowRedirects)
 * @method \Guanguans\Notify\Foundation\Client auth(array $auth)
 * @method \Guanguans\Notify\Foundation\Client baseUri(string $baseUri)
 * @method \Guanguans\Notify\Foundation\Client body(null|callable|float|int|\Iterator|\Psr\Http\Message\StreamInterface|resource|string $body)
 * @method \Guanguans\Notify\Foundation\Client cert(array|string $cert)
 * @method \Guanguans\Notify\Foundation\Client connectTimeout(float $connectTimeout)
 * @method \Guanguans\Notify\Foundation\Client cookies(bool|\GuzzleHttp\Cookie\CookieJarInterface $cookies)
 * @method \Guanguans\Notify\Foundation\Client cryptoMethod(int $cryptoMethod)
 * @method \Guanguans\Notify\Foundation\Client curl(array $curl)
 * @method \Guanguans\Notify\Foundation\Client debug(bool|resource $debug)
 * @method \Guanguans\Notify\Foundation\Client decodeContent(bool $decodeContent)
 * @method \Guanguans\Notify\Foundation\Client delay(int $delay)
 * @method \Guanguans\Notify\Foundation\Client expect(bool|integer $expect)
 * @method \Guanguans\Notify\Foundation\Client forceIpResolve(bool $forceIpResolve)
 * @method \Guanguans\Notify\Foundation\Client formParams(array $formParams)
 * @method \Guanguans\Notify\Foundation\Client headers(array $headers)
 * @method \Guanguans\Notify\Foundation\Client httpErrors(bool $httpErrors)
 * @method \Guanguans\Notify\Foundation\Client idnConversion(bool|int $idnConversion)
 * @method \Guanguans\Notify\Foundation\Client json(mixed $json)
 * @method \Guanguans\Notify\Foundation\Client multipart(array $multipart)
 * @method \Guanguans\Notify\Foundation\Client onHeaders(callable $onHeaders)
 * @method \Guanguans\Notify\Foundation\Client onStats(callable $onStats)
 * @method \Guanguans\Notify\Foundation\Client progress(callable $progress)
 * @method \Guanguans\Notify\Foundation\Client proxy(array|string $proxy)
 * @method \Guanguans\Notify\Foundation\Client query(array|string $query)
 * @method \Guanguans\Notify\Foundation\Client readTimeout(float $readTimeout)
 * @method \Guanguans\Notify\Foundation\Client sink(\Psr\Http\Message\StreamInterface|resource|string $sink)
 * @method \Guanguans\Notify\Foundation\Client sslKey(array|string $sslKey)
 * @method \Guanguans\Notify\Foundation\Client stream(mixed $stream)
 * @method \Guanguans\Notify\Foundation\Client synchronous(bool $synchronous)
 * @method \Guanguans\Notify\Foundation\Client timeout(float $timeout)
 * @method \Guanguans\Notify\Foundation\Client verify(bool|string $verify)
 * @method \Guanguans\Notify\Foundation\Client version(float $version)
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

        if (!\in_array($snakedName = Str::snake($name), Utils::httpOptionConstants(), true)) {
            throw new BadMethodCallException(\sprintf('The method [%s::%s] does not exist.', static::class, $name));
        }

        if (1 !== ($numberOfArguments = \count($arguments))) {
            throw new InvalidArgumentException(\sprintf(
                'The method [%s::%s] only accepts 1 argument, %s given.',
                static::class,
                $name,
                $numberOfArguments
            ));
        }

        return $this->setHttpOptions([$snakedName => $arguments[0]]);
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
     * @param null|list<ResponseInterface|\Throwable>|ResponseInterface|\Throwable $queue
     */
    public function mock(mixed $queue = null, ?callable $onFulfilled = null, ?callable $onRejected = null): self
    {
        if (null !== $queue && !\is_array($queue)) {
            $queue = [$queue];
        }

        $this->setHandler(new MockHandler($queue, $onFulfilled, $onRejected));

        return $this;
    }
}
