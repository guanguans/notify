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

use Guanguans\Notify\Foundation\Support\Str;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\Create;
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
 */
class MockHandler extends \GuzzleHttp\Handler\MockHandler
{
    private array $responseMapper = [];

    /**
     * @var null|callable
     */
    private $onFulfilled;

    /**
     * @var null|callable
     */
    private $onRejected;

    public function __construct(
        ?array $responseMapper = null,
        ?callable $onFulfilled = null,
        ?callable $onRejected = null
    ) {
        $this->onFulfilled = $onFulfilled;
        $this->onRejected = $onRejected;

        if ($responseMapper) {
            $this->withResponseMapper($responseMapper);
        }

        parent::__construct($responseMapper, $onFulfilled, $onRejected);
    }

    public function __invoke(RequestInterface $request, array $options): PromiseInterface
    {
        if (! $this->responseMapper) {
            throw new \OutOfBoundsException('Mock response mapper is empty');
        }

        if (isset($options['delay']) && is_numeric($options['delay'])) {
            usleep((int) $options['delay'] * 1000);
        }

        // $this->lastRequest = $request;
        // $this->lastOptions = $options;
        // $response = array_shift($this->queue);
        $response = $this->matchResponse($request);

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
            ? Create::rejectionFor($response)
            : Create::promiseFor($response);

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

                return Create::rejectionFor($reason);
            }
        );
    }

    public function withResponseMapper(array $responseMapper): self
    {
        foreach ($responseMapper as $uriPattern => $response) {
            if (
                $response instanceof ResponseInterface
                || $response instanceof \Throwable
                || $response instanceof PromiseInterface
                || \is_callable($response)
            ) {
                $this->responseMapper[$uriPattern] = $response;
            } else {
                throw new \TypeError('Expected a Response, Promise, Throwable or callable. Found '.Utils::describeType($response));
            }
        }

        return $this;
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

    private function matchResponse(RequestInterface $request): ResponseInterface
    {
        $uri = (string) $request->getUri();

        foreach ($this->responseMapper as $uriPattern => $response) {
            if (Str::is($uriPattern, $uri)) {
                return $response;
            }
        }

        throw new \OutOfBoundsException("No matching mock response for URI: $uri");
    }
}
