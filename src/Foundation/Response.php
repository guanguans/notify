<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * @see https://github.com/laravel/framework/blob/10.x/src/Illuminate/Http/Client/Response.php
 */
class Response extends GuzzleResponse implements \ArrayAccess
{
    // use Concerns\DeterminesStatusCode;

    /**
     * The request cookies.
     */
    public \GuzzleHttp\Cookie\CookieJar $cookies;

    /**
     * The transfer stats for the request.
     */
    public ?\GuzzleHttp\TransferStats $transferStats = null;

    /**
     * The underlying PSR response.
     */
    protected ResponseInterface $response;

    /**
     * The decoded JSON response.
     */
    protected array $decoded = [];

    /**
     * Create a new response instance.
     *
     * @param null|mixed $body
     *
     * @return void
     */
    public function __construct(
        int $status = 200,
        array $headers = [],
        $body = null,
        string $version = '1.1',
        ?string $reason = null
    ) {
        parent::__construct($status, $headers, $body, $version, $reason);
        $this->response = $this;
    }

    /**
     * Get the body of the response.
     */
    public function __toString(): string
    {
        return $this->body();
    }

    public static function createFromPsrResponse(ResponseInterface $response): self
    {
        return new static(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }

    /**
     * Get the body of the response.
     */
    public function body(): string
    {
        return (string) $this->response->getBody();
    }

    /**
     * Get the JSON decoded body of the response as an array or scalar value.
     *
     * @param mixed $default
     *
     * @return mixed
     */
    public function json(?string $key = null, $default = null)
    {
        if (! $this->decoded) {
            $this->decoded = json_decode($this->body(), true);
        }

        if (null === $key) {
            return $this->decoded;
        }

        return data_get($this->decoded, $key, $default);
    }

    /**
     * Get the JSON decoded body of the response as an object.
     */
    public function object(): ?object
    {
        return json_decode($this->body(), false);
    }

    /**
     * Get a header from the response.
     */
    public function header(string $header): string
    {
        return $this->response->getHeaderLine($header);
    }

    /**
     * Get the headers from the response.
     */
    public function headers(): array
    {
        return $this->response->getHeaders();
    }

    /**
     * Get the status code of the response.
     */
    public function status(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * Get the reason phrase of the response.
     */
    public function reason(): string
    {
        return $this->response->getReasonPhrase();
    }

    /**
     * Get the effective URI of the response.
     */
    public function effectiveUri(): ?\Psr\Http\Message\UriInterface
    {
        if ($this->transferStats instanceof \GuzzleHttp\TransferStats) {
            return $this->transferStats->getEffectiveUri();
        }
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
     *
     * @return $this
     */
    public function onError(callable $callback): self
    {
        if ($this->failed()) {
            $callback($this);
        }

        return $this;
    }

    /**
     * Get the response cookies.
     */
    public function cookies(): \GuzzleHttp\Cookie\CookieJar
    {
        return $this->cookies;
    }

    /**
     * Get the handler stats of the response.
     */
    public function handlerStats(): array
    {
        if (! $this->transferStats instanceof \GuzzleHttp\TransferStats) {
            return [];
        }

        return $this->transferStats->getHandlerStats() ?? [];
    }

    /**
     * Close the stream and any underlying resources.
     *
     * @return $this
     */
    public function close(): self
    {
        $this->response->getBody()->close();

        return $this;
    }

    /**
     * Get the underlying PSR response for the response.
     */
    public function toPsrResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * Create an exception if a server or client error occurred.
     */
    public function toException(): ?\Illuminate\Http\Client\RequestException
    {
        if ($this->failed()) {
            return new RequestException($this);
        }
    }

    /**
     * Throw an exception if a server or client error occurred.
     *
     * @return $this
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function throw(): self
    {
        $callback = \func_get_args()[0] ?? null;

        if ($this->failed()) {
            throw tap($this->toException(), function ($exception) use ($callback): void {
                if ($callback && \is_callable($callback)) {
                    $callback($this, $exception);
                }
            });
        }

        return $this;
    }

    /**
     * Throw an exception if a server or client error occurred and the given condition evaluates to true.
     *
     * @param bool|\Closure $condition
     *
     * @return $this
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function throwIf($condition): self
    {
        return value($condition, $this) ? $this->throw(\func_get_args()[1] ?? null) : $this;
    }

    /**
     * Throw an exception if the response status code matches the given code.
     *
     * @param callable|int $statusCode
     *
     * @return $this
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function throwIfStatus($statusCode): self
    {
        if (\is_callable($statusCode)
            && $statusCode($this->status(), $this)) {
            return $this->throw();
        }

        return $this->status() === $statusCode ? $this->throw() : $this;
    }

    /**
     * Throw an exception unless the response status code matches the given code.
     *
     * @param callable|int $statusCode
     *
     * @return $this
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function throwUnlessStatus($statusCode): self
    {
        if (\is_callable($statusCode)) {
            return $statusCode($this->status(), $this) ? $this : $this->throw();
        }

        return $this->status() === $statusCode ? $this : $this->throw();
    }

    /**
     * Throw an exception if the response status code is a 4xx level code.
     *
     * @return $this
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function throwIfClientError(): self
    {
        return $this->clientError() ? $this->throw() : $this;
    }

    /**
     * Throw an exception if the response status code is a 5xx level code.
     *
     * @return $this
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function throwIfServerError(): self
    {
        return $this->serverError() ? $this->throw() : $this;
    }

    /**
     * Determine if the given offset exists.
     *
     * @param mixed $offset
     */
    public function offsetExists($offset): bool
    {
        return isset($this->json()[$offset]);
    }

    /**
     * Get the value for a given offset.
     *
     * @param mixed $offset
     */
    public function offsetGet($offset)
    {
        return $this->json()[$offset];
    }

    /**
     * Set the value at the given offset.
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @throws \LogicException
     */
    public function offsetSet($offset, $value): void
    {
        throw new \LogicException('Response data may not be mutated using array access.');
    }

    /**
     * Unset the value at the given offset.
     *
     * @param mixed $offset
     *
     * @throws \LogicException
     */
    public function offsetUnset($offset): void
    {
        throw new \LogicException('Response data may not be mutated using array access.');
    }
}
