<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation;

use Guanguans\Notify\Foundation\Authenticators\AggregateAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\NullAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\OptionsAuthenticator;
use Guanguans\Notify\Foundation\Concerns\Dumpable;
use Guanguans\Notify\Foundation\Concerns\HasHttpClient;
use Guanguans\Notify\Foundation\Contracts\Authenticator;
use Guanguans\Notify\Foundation\Contracts\Message;
use Guanguans\Notify\Foundation\Support\Utils;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\RequestOptions;
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
        return $this->mergeDebugInfo([
            'httpClient' => $this->getHttpClient(),
            'httpClientResolver' => $this->getHttpClientResolver(),
            'handlerStack' => $this->getHandlerStack(),
            'httpOptions' => $this->getHttpOptions(),
        ]);
    }

    /**
     * @throws GuzzleException
     *
     * @return Response|ResponseInterface
     */
    public function send(Message $message): ResponseInterface
    {
        // $this->authenticator = new AggregateAuthenticator(
        //     $this->authenticator,
        //     new OptionsAuthenticator([RequestOptions::SYNCHRONOUS => true])
        // );

        return $this->synchronous(true)->sendAsync($message)->wait();
    }

    /**
     * @throws GuzzleException
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
        // return Utils::settle($promises)->wait();
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
