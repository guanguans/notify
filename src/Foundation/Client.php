<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation;

use Guanguans\Notify\Foundation\Authenticators\NullAuthenticator;
use Guanguans\Notify\Foundation\Concerns\Dumpable;
use Guanguans\Notify\Foundation\Concerns\HasHttpClient;
use Guanguans\Notify\Foundation\Contracts\Authenticator;
use Guanguans\Notify\Foundation\Contracts\Message;
use Guanguans\Notify\Foundation\Support\Utils;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

class Client implements Contracts\Client
{
    use Dumpable;
    use HasHttpClient;
    private Authenticator $authenticator;

    public function __construct(?Authenticator $authenticator = null)
    {
        $this->authenticator = $authenticator ?? new NullAuthenticator;
    }

    public function __debugInfo(): array
    {
        $this->getHttpClient();

        return $this->mergeDebugInfo([
            // 'httpClient' => $this->getHttpClient(),
            // 'httpClientResolver' => $this->getHttpClientResolver(),
            // 'handlerStack' => $this->getHandlerStack(),
            // 'handlerStackResolver' => $this->getHandlerStackResolver(),
            // 'httpOptions' => $this->getHttpOptions(),
        ]);
    }

    public function getAuthenticator(): Authenticator
    {
        return $this->authenticator;
    }

    public function setAuthenticator(Authenticator $authenticator): self
    {
        $this->authenticator = $authenticator;

        return $this;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return Response
     */
    public function send(Message $message): ResponseInterface
    {
        return $this->synchronous(true)->sendAsync($message)->wait();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendAsync(Message $message): PromiseInterface
    {
        return $this->getHttpClient()->requestAsync(
            $message->toHttpMethod(),
            $message->toHttpUri(),
            Utils::normalizeHttpOptions($this->authenticator->applyToOptions($message->toHttpOptions())),
        );
    }

    /**
     * @see https://docs.guzzlephp.org/en/stable/quickstart.html#concurrent-requests
     * @see \GuzzleHttp\Pool
     *
     * @param iterable<array-key, Message> $messages
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     *
     * @return array<array-key, Response|ResponseInterface>
     */
    public function pool(iterable $messages): array
    {
        /** @noinspection PhpParamsInspection */
        return \GuzzleHttp\Promise\Utils::unwrap(
            (function (iterable $messages): \Generator {
                foreach ($messages as $key => $message) {
                    yield $key => $this->sendAsync($message);
                }
            })($messages)
        );
    }
}
