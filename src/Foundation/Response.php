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

use Guanguans\Notify\Foundation\Concerns\DeterminesStatusCode;
use Guanguans\Notify\Foundation\Concerns\WithDumpable;
use Guanguans\Notify\Foundation\Exceptions\LogicException;
use Guanguans\Notify\Foundation\Exceptions\RequestException;
use Guanguans\Notify\Foundation\Support\Arr;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\TransferStats;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @template-implements \ArrayAccess<string, mixed>
 *
 * @see https://github.com/laravel/framework
 */
class Response extends \GuzzleHttp\Psr7\Response implements \ArrayAccess
{
    use DeterminesStatusCode;
    use WithDumpable;

    public ?RequestInterface $request = null;

    /**
     * The request cookies.
     */
    public ?CookieJar $cookies = null;

    /**
     * The transfer stats for the request.
     */
    public ?TransferStats $transferStats = null;

    /**
     * The decoded JSON response.
     */
    protected ?array $decoded = null;

    public function __debugInfo(): array
    {
        $debugInfo = [
            'handlerStats' => $this->handlerStats(),
            'headers' => array_map(static fn (array $header): string => $header[0], $this->headers()),
            'status' => $this->status(),
            'reason' => $this->reason(),
            'body' => $this->body(),
            'bodyDecoded' => $this->json(),
        ];

        return class_exists(VarDumper::class) ? $debugInfo : get_object_vars($this) + $debugInfo;
    }

    /**
     * Get the body of the response.
     */
    public function __toString(): string
    {
        return $this->body();
    }

    public static function fromPsrResponse(ResponseInterface $response): self
    {
        return $response instanceof static ? $response : new static(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
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
     * @param mixed $default
     *
     * @return mixed
     *
     * @noinspection JsonEncodingApiUsageInspection
     */
    public function json(?string $key = null, $default = null)
    {
        if (! $this->decoded) {
            $this->decoded = json_decode($this->body(), true);
        }

        if (null === $key) {
            return $this->decoded;
        }

        return Arr::get($this->decoded, $key, $default);
    }

    /**
     * Get the JSON decoded body of the response as an object.
     *
     * @noinspection JsonEncodingApiUsageInspection
     */
    public function object(): ?object
    {
        return json_decode($this->body());
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

    public function request(): ?RequestInterface
    {
        return $this->request;
    }

    /**
     * Get the response cookies.
     */
    public function cookies(): ?CookieJar
    {
        return $this->cookies;
    }

    /**
     * Get the handler stats of the response.
     */
    public function handlerStats(): array
    {
        return $this->transferStats instanceof TransferStats ? $this->transferStats->getHandlerStats() : [];
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
     * @throws RequestException
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
     * @throws RequestException
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
     * @throws RequestException
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
     * @param mixed|string $offset
     */
    public function offsetExists($offset): bool
    {
        return isset($this->json()[$offset]);
    }

    /**
     * Get the value for a given offset.
     *
     * @param mixed|string $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->json()[$offset];
    }

    /**
     * Set the value at the given offset.
     *
     * @param mixed|string $offset
     * @param mixed $value
     *
     * @throws \LogicException
     */
    public function offsetSet($offset, $value): void
    {
        throw new LogicException('Response data may not be mutated using array access.');
    }

    /**
     * Unset the value at the given offset.
     *
     * @param mixed|string $offset
     *
     * @throws \LogicException
     */
    public function offsetUnset($offset): void
    {
        throw new LogicException('Response data may not be mutated using array access.');
    }
}
