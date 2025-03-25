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
 * @method \Guanguans\Notify\Foundation\Client remove($remove)
 * @method \Guanguans\Notify\Foundation\Client allowRedirects($allowRedirects)
 * @method \Guanguans\Notify\Foundation\Client auth($auth)
 * @method \Guanguans\Notify\Foundation\Client baseUri($baseUri)
 * @method \Guanguans\Notify\Foundation\Client body($body)
 * @method \Guanguans\Notify\Foundation\Client cert($cert)
 * @method \Guanguans\Notify\Foundation\Client connectTimeout($connectTimeout)
 * @method \Guanguans\Notify\Foundation\Client cookies($cookies)
 * @method \Guanguans\Notify\Foundation\Client cryptoMethod($cryptoMethod)
 * @method \Guanguans\Notify\Foundation\Client curl($curl)
 * @method \Guanguans\Notify\Foundation\Client debug($debug)
 * @method \Guanguans\Notify\Foundation\Client decodeContent($decodeContent)
 * @method \Guanguans\Notify\Foundation\Client delay($delay)
 * @method \Guanguans\Notify\Foundation\Client expect($expect)
 * @method \Guanguans\Notify\Foundation\Client forceIpResolve($forceIpResolve)
 * @method \Guanguans\Notify\Foundation\Client formParams($formParams)
 * @method \Guanguans\Notify\Foundation\Client headers($headers)
 * @method \Guanguans\Notify\Foundation\Client httpErrors($httpErrors)
 * @method \Guanguans\Notify\Foundation\Client idnConversion($idnConversion)
 * @method \Guanguans\Notify\Foundation\Client json($json)
 * @method \Guanguans\Notify\Foundation\Client multipart($multipart)
 * @method \Guanguans\Notify\Foundation\Client onHeaders($onHeaders)
 * @method \Guanguans\Notify\Foundation\Client onStats($onStats)
 * @method \Guanguans\Notify\Foundation\Client progress($progress)
 * @method \Guanguans\Notify\Foundation\Client proxy($proxy)
 * @method \Guanguans\Notify\Foundation\Client query($query)
 * @method \Guanguans\Notify\Foundation\Client readTimeout($readTimeout)
 * @method \Guanguans\Notify\Foundation\Client sink($sink)
 * @method \Guanguans\Notify\Foundation\Client sslKey($sslKey)
 * @method \Guanguans\Notify\Foundation\Client stream($stream)
 * @method \Guanguans\Notify\Foundation\Client synchronous($synchronous)
 * @method \Guanguans\Notify\Foundation\Client timeout($timeout)
 * @method \Guanguans\Notify\Foundation\Client verify($verify)
 * @method \Guanguans\Notify\Foundation\Client version($version)
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
     * @param null|list<ResponseInterface|\Throwable> $queue
     */
    public function mock(?array $queue = null, ?callable $onFulfilled = null, ?callable $onRejected = null): self
    {
        $this->setHandler(new MockHandler($queue, $onFulfilled, $onRejected));

        return $this;
    }
}
