<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Testing;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Promise as P;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\TransferStats;
use GuzzleHttp\Utils;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Handler that returns responses or throw exceptions from a queue.
 *
 * @final
 *
 * @see \GuzzleHttp\Handler\MockHandler
 */
class MockHandler implements \Countable
{
    private array $queue = [];

    private ?RequestInterface $lastRequest = null;

    private array $lastOptions = [];

    /**
     * @var null|callable
     */
    private $onFulfilled;

    /**
     * @var null|callable
     */
    private $onRejected;

    /**
     * The passed in value must be an array of
     * {@see \Psr\Http\Message\ResponseInterface} objects, Exceptions,
     * callables, or Promises.
     *
     * @param null|array<int, mixed> $queue the parameters to be passed to the append function, as an indexed array
     * @param null|callable $onFulfilled callback to invoke when the return value is fulfilled
     * @param null|callable $onRejected callback to invoke when the return value is rejected
     */
    public function __construct(?array $queue = null, ?callable $onFulfilled = null, ?callable $onRejected = null)
    {
        $this->onFulfilled = $onFulfilled;
        $this->onRejected = $onRejected;

        if ($queue) {
            // array_values included for BC
            $this->append(...array_values($queue));
        }
    }

    public function __invoke(RequestInterface $request, array $options): PromiseInterface
    {
        if (! $this->queue) {
            throw new \OutOfBoundsException('Mock queue is empty');
        }

        if (isset($options['delay']) && is_numeric($options['delay'])) {
            usleep((int) $options['delay'] * 1000);
        }

        $this->lastRequest = $request;
        $this->lastOptions = $options;
        $response = array_shift($this->queue);

        if (isset($options['on_headers'])) {
            if (! \is_callable($options['on_headers'])) {
                throw new \InvalidArgumentException('on_headers must be callable');
            }

            try {
                $options['on_headers']($response);
            } catch (\Exception $e) {
                $msg = 'An error was encountered during the on_headers event';
                $response = new RequestException($msg, $request, $response, $e);
            }
        }

        if (\is_callable($response)) {
            $response = $response($request, $options);
        }

        $response = $response instanceof \Throwable
            ? P\Create::rejectionFor($response)
            : P\Create::promiseFor($response);

        return $response->then(
            function (?ResponseInterface $response) use ($request, $options): ?ResponseInterface {
                $this->invokeStats($request, $options, $response);
                if ($this->onFulfilled) {
                    ($this->onFulfilled)($response);
                }

                if ($response instanceof ResponseInterface && isset($options['sink'])) {
                    $contents = (string) $response->getBody();
                    $sink = $options['sink'];

                    if (\is_resource($sink)) {
                        fwrite($sink, $contents);
                    } elseif (\is_string($sink)) {
                        file_put_contents($sink, $contents);
                    } elseif ($sink instanceof StreamInterface) {
                        $sink->write($contents);
                    }
                }

                return $response;
            },
            function ($reason) use ($request, $options): PromiseInterface {
                $this->invokeStats($request, $options, null, $reason);
                if ($this->onRejected) {
                    ($this->onRejected)($reason);
                }

                return P\Create::rejectionFor($reason);
            }
        );
    }

    /**
     * Creates a new MockHandler that uses the default handler stack list of
     * middlewares.
     *
     * @param null|array $queue array of responses, callables, or exceptions
     * @param null|callable $onFulfilled callback to invoke when the return value is fulfilled
     * @param null|callable $onRejected callback to invoke when the return value is rejected
     */
    public static function createWithMiddleware(
        ?array $queue = null,
        ?callable $onFulfilled = null,
        ?callable $onRejected = null
    ): HandlerStack {
        return HandlerStack::create(new self($queue, $onFulfilled, $onRejected));
    }

    /**
     * Adds one or more variadic requests, exceptions, callables, or promises
     * to the queue.
     *
     * @param mixed ...$values
     */
    public function append(...$values): void
    {
        foreach ($values as $value) {
            if ($value instanceof ResponseInterface
                || $value instanceof \Throwable
                || $value instanceof PromiseInterface
                || \is_callable($value)
            ) {
                $this->queue[] = $value;
            } else {
                throw new \TypeError('Expected a Response, Promise, Throwable or callable. Found '.Utils::describeType($value));
            }
        }
    }

    /**
     * Get the last received request.
     */
    public function getLastRequest(): ?RequestInterface
    {
        return $this->lastRequest;
    }

    /**
     * Get the last received request options.
     */
    public function getLastOptions(): array
    {
        return $this->lastOptions;
    }

    /**
     * Returns the number of remaining items in the queue.
     */
    public function count(): int
    {
        return \count($this->queue);
    }

    public function reset(): void
    {
        $this->queue = [];
    }

    /**
     * @param mixed $reason promise or reason
     */
    private function invokeStats(
        RequestInterface $request,
        array $options,
        ?ResponseInterface $response = null,
        $reason = null
    ): void {
        if (isset($options['on_stats'])) {
            $transferTime = $options['transfer_time'] ?? 0;
            $transferStats = new TransferStats($request, $response, $transferTime, $reason);
            ($options['on_stats'])($transferStats);
        }
    }
}
