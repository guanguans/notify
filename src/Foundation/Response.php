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

namespace Guanguans\Notify\Foundation;

use Guanguans\Notify\Foundation\Concerns\DeterminesStatusCode;
use Guanguans\Notify\Foundation\Concerns\Dumpable;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Foundation\Exceptions\LogicException;
use Guanguans\Notify\Foundation\Exceptions\RequestException;
use Guanguans\Notify\Foundation\Support\Arr;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\MimeType;
use GuzzleHttp\Psr7\StreamWrapper;
use GuzzleHttp\TransferStats;
use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use function Guanguans\Notify\Foundation\Support\value;

/**
 * @template-implements \ArrayAccess<string, mixed>
 *
 * @see https://github.com/laravel/framework
 * @see https://github.com/saloonphp/saloon
 * @see https://github.com/w7corp/easywechat
 */
class Response extends \GuzzleHttp\Psr7\Response implements \ArrayAccess, \Stringable
{
    use DeterminesStatusCode;
    use Dumpable;

    /** The request that generated response. */
    protected ?RequestInterface $request = null;

    /** The request cookies. */
    protected ?CookieJar $cookies = null;

    /** The transfer stats for the request. */
    protected ?TransferStats $transferStats = null;

    /** The decoded JSON response. */
    protected array $decoded;

    /**
     * Provide debug information about the response.
     *
     * @throws \JsonException
     */
    public function __debugInfo(): array
    {
        return $this->mergeDebugInfo([
            'handlerStats' => $this->handlerStats(),
            'requestSummary' => $this->request instanceof RequestInterface ? Message::toString($this->request) : null,
            'responseSummary' => Message::toString($this),
            'decodedBody' => $this->json(),
        ]);
    }

    /**
     * Get the body of the response.
     */
    public function __toString(): string
    {
        return $this->body();
    }

    /**
     * Create an instance from a PSR response.
     */
    public static function fromPsrResponse(ResponseInterface $response): self
    {
        return $response instanceof self ? $response : new self(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase(),
        );
    }

    /**
     * Get the body of the response.
     *
     * @noinspection ToStringCallInspection
     */
    public function body(): string
    {
        return (string) $this->getBody();
    }

    /**
     * Get the JSON decoded body of the response as an array or scalar value.
     *
     * @param array-key $key
     *
     * @throws \JsonException
     *
     * @return array|mixed
     */
    public function json(mixed $key = null, mixed $default = null): mixed
    {
        if (!isset($this->decoded)) {
            $this->decoded = json_decode($this->body() ?: '[]', true, 512, \JSON_THROW_ON_ERROR);
        }

        if (null === $key) {
            return $this->decoded;
        }

        return Arr::get($this->decoded, $key, $default);
    }

    /**
     * Alias of json().
     *
     * @param array-key $key
     *
     * @throws \JsonException
     *
     * @return array|mixed
     */
    public function array(mixed $key = null, mixed $default = null): mixed
    {
        return $this->json($key, $default);
    }

    /**
     * Get the JSON decoded body of the response as an object.
     *
     * @throws \JsonException
     *
     * @return mixed|object
     */
    public function object(): mixed
    {
        return json_decode($this->body(), null, 512, \JSON_THROW_ON_ERROR);
    }

    /**
     * Get the JSON decoded body of the response as a collection object.
     * To use the "collect" method you must install the illuminate/collections package.
     * Requires Laravel Collections (composer require illuminate/collections).
     *
     * @see https://github.com/illuminate/collections
     *
     * @param array-key $key
     *
     * @throws \JsonException
     */
    public function collect(mixed $key = null): Collection
    {
        return Collection::make($this->json($key));
    }

    /**
     * Get the JSON decoded body of the response as a fluent object.
     * To use the "fluent" method you must install the illuminate/support package.
     * Requires Laravel Support (composer require illuminate/support).
     *
     * @param array-key $key
     *
     * @throws \JsonException
     */
    public function fluent(mixed $key = null): Fluent
    {
        return new Fluent((array) $this->json($key));
    }

    /**
     * Convert the XML response into a \SimpleXMLElement.
     *
     * Suitable for reading small, simple XML responses but not suitable for
     * more advanced XML responses with namespaces and prefixes. Consider
     * using the xmlReader method instead for better compatability.
     *
     * @see https://www.php.net/manual/en/book.simplexml.php
     */
    public function xml(mixed ...$arguments): false|\SimpleXMLElement
    {
        return simplexml_load_string($this->body(), ...$arguments);
    }

    /**
     * Generate a data URL from the content type and body.
     */
    public function dataUrl(): string
    {
        return \sprintf('data:%s;base64,%s', $this->getHeaderLine('Content-Type'), base64_encode($this->body()));
    }

    /**
     * Get the body of the response as a PHP resource.
     * Useful for storing the file.
     * Make sure to close the [guzzle://stream] resource after you have used it.
     *
     * @throws \InvalidArgumentException
     *
     * @return resource
     */
    public function resource(): mixed
    {
        return StreamWrapper::getResource($this->getBody());
    }

    /**
     * Get the body as a stream.
     */
    public function stream(): StreamInterface
    {
        $stream = $this->getBody();

        if ($stream->isSeekable()) {
            $stream->rewind();
        }

        return $stream;
    }

    /**
     * Save the response to resource or file.
     *
     * @param resource|string $resourceOrPath
     */
    public function saveAs(mixed $resourceOrPath): void
    {
        if (!\is_string($resourceOrPath) && !\is_resource($resourceOrPath)) {
            throw new InvalidArgumentException('The $resourceOrPath argument must be either a file path or a resource.');
        }

        $resource = \is_string($resourceOrPath) ? fopen($resourceOrPath, 'wb+') : $resourceOrPath;

        if (false === $resource) {
            throw new LogicException('Unable to open the resource.');
        }

        rewind($resource);
        $stream = $this->stream();

        while (!$stream->eof()) {
            fwrite($resource, $stream->read(1024));
        }

        rewind($resource);
        fclose($resource);
    }

    /**
     * Check if the content type matches the given type.
     */
    public function is(string $type): bool
    {
        return strtolower($this->getHeaderLine('Content-Type')) === MimeType::fromExtension($type);
    }

    /**
     * Get a header from the response.
     */
    public function header(string $header): string
    {
        return $this->getHeaderLine($header);
    }

    /**
     * Get the headers from the response.
     */
    public function headers(): array
    {
        return $this->getHeaders();
    }

    /**
     * Get the status code of the response.
     */
    public function status(): int
    {
        return $this->getStatusCode();
    }

    /**
     * Get the reason phrase of the response.
     */
    public function reason(): string
    {
        return $this->getReasonPhrase();
    }

    /**
     * Get the effective URI of the response.
     */
    public function effectiveUri(): ?UriInterface
    {
        return $this->transferStats instanceof TransferStats ? $this->transferStats->getEffectiveUri() : null;
    }

    /**
     * Determine if the request was successful.
     */
    public function successful(): bool
    {
        return $this->status() >= 200 && $this->status() < 300;
    }

    /**
     * Determine if the response was a redirect.
     */
    public function redirect(): bool
    {
        return $this->status() >= 300 && $this->status() < 400;
    }

    /**
     * Determine if the response indicates a client or server error occurred.
     */
    public function failed(): bool
    {
        return $this->serverError() || $this->clientError();
    }

    /**
     * Determine if the response indicates a client error occurred.
     */
    public function clientError(): bool
    {
        return $this->status() >= 400 && $this->status() < 500;
    }

    /**
     * Determine if the response indicates a server error occurred.
     */
    public function serverError(): bool
    {
        return $this->status() >= 500;
    }

    /**
     * Execute the given callback if there was a server or client error.
     */
    public function onError(callable $callback): self
    {
        if ($this->failed()) {
            $callback($this);
        }

        return $this;
    }

    /**
     * Get or set the request that generated response.
     */
    public function request(?RequestInterface $request = null): ?RequestInterface
    {
        if (0 === \func_num_args()) {
            return $this->request;
        }

        if ($this->request instanceof RequestInterface) {
            throw new LogicException('Request already set on the response.');
        }

        return $this->request = $request;
    }

    /**
     * Get or set the response cookies.
     */
    public function cookies(?CookieJar $cookieJar = null): ?CookieJar
    {
        if (0 === \func_num_args()) {
            return $this->cookies;
        }

        if ($this->cookies instanceof CookieJar) {
            throw new LogicException('Cookies already set on the response.');
        }

        return $this->cookies = $cookieJar;
    }

    /**
     * Get or set the transfer stats of the response.
     */
    public function transferStats(?TransferStats $transferStats = null): ?TransferStats
    {
        if (0 === \func_num_args()) {
            return $this->transferStats;
        }

        if ($this->transferStats instanceof TransferStats) {
            throw new LogicException('Transfer stats already set on the response.');
        }

        return $this->transferStats = $transferStats;
    }

    /**
     * Get the handler stats of the response.
     */
    public function handlerStats(): ?array
    {
        return $this->transferStats instanceof TransferStats ? $this->transferStats->getHandlerStats() : null;
    }

    /**
     * Close the stream and any underlying resources.
     */
    public function close(): self
    {
        $this->getBody()->close();

        return $this;
    }

    /**
     * Create an exception if a server or client error occurred.
     */
    public function toException(): ?RequestException
    {
        return $this->failed() ? RequestException::create($this->request, $this) : null;
    }

    /**
     * Throw an exception if a server or client error occurred.
     *
     * @throws RequestException
     */
    public function throw(?callable $callback = null): self
    {
        if ($this->failed()) {
            /** @var \Guanguans\Notify\Foundation\Exceptions\RequestException $requestException */
            $requestException = $this->toException();
            $callback and $callback($this, $requestException);

            throw $requestException;
        }

        return $this;
    }

    /**
     * Throw an exception if a server or client error occurred and the given condition evaluates to true.
     *
     * @param bool|\Closure|mixed $condition
     *
     * @throws RequestException
     */
    public function throwIf(mixed $condition, ?callable $callback = null): self
    {
        return value($condition, $this) ? $this->throw($callback) : $this;
    }

    /**
     * Throw an exception if the response status code matches the given code.
     *
     * @throws RequestException
     */
    public function throwIfStatus(callable|int $statusCode): self
    {
        if (\is_callable($statusCode) && $statusCode($this->status(), $this)) {
            return $this->throw();
        }

        return $this->status() === $statusCode ? $this->throw() : $this;
    }

    /**
     * Throw an exception unless the response status code matches the given code.
     *
     * @throws RequestException
     */
    public function throwUnlessStatus(callable|int $statusCode): self
    {
        if (\is_callable($statusCode)) {
            return $statusCode($this->status(), $this) ? $this : $this->throw();
        }

        return $this->status() === $statusCode ? $this : $this->throw();
    }

    /**
     * Throw an exception if the response status code is a 4xx level code.
     *
     * @throws RequestException
     */
    public function throwIfClientError(): self
    {
        return $this->clientError() ? $this->throw() : $this;
    }

    /**
     * Throw an exception if the response status code is a 5xx level code.
     *
     * @throws RequestException
     */
    public function throwIfServerError(): self
    {
        return $this->serverError() ? $this->throw() : $this;
    }

    /**
     * Determine if the given offset exists.
     *
     * @param array-key $offset
     *
     * @throws \JsonException
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->json()[$offset]);
    }

    /**
     * Get the value for a given offset.
     *
     * @param array-key $offset
     *
     * @throws \JsonException
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->json()[$offset] ?? null;
    }

    /**
     * Set the value at the given offset.
     *
     * @param array-key $offset
     *
     * @throws \LogicException
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new LogicException('Response data may not be mutated using array access.');
    }

    /**
     * Unset the value at the given offset.
     *
     * @param array-key $offset
     *
     * @throws \LogicException
     */
    public function offsetUnset(mixed $offset): void
    {
        throw new LogicException('Response data may not be mutated using array access.');
    }
}
