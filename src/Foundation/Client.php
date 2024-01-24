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

use Guanguans\Notify\Foundation\Contracts\Credential;
use Guanguans\Notify\Foundation\Credentials\NullCredential;
use Guanguans\Notify\Foundation\Middleware\ApplyCredentialToRequest;
use Guanguans\Notify\Foundation\Traits\Tappable;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\ResponseInterface;

class Client implements Contracts\Client
{
    use Tappable;

    private Credential $credential;
    private ?GuzzleClient $httpClient;
    private HandlerStack $handlerStack;

    public function __construct(Credential $credential = null, GuzzleClient $httpClient = null)
    {
        $this->credential = $credential ?? new NullCredential();
        $this->httpClient = $httpClient;
        $this->handlerStack = HandlerStack::create();
    }

    /**
     * @throws GuzzleException
     */
    public function send(Contracts\Message $message): ResponseInterface
    {
        return $this
            ->createHttpClient()
            ->request(
                $message->httpMethod(),
                $message->httpUri(),
                $this->credential->applyToOptions($message->toHttpOptions())
            );
    }

    public function setHttpClient(?GuzzleClient $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function setHandlerStack(HandlerStack $handlerStack): self
    {
        $this->handlerStack = $handlerStack;

        return $this;
    }

    public function pushMiddleware(callable $callable, string $name = ''): self
    {
        $this->handlerStack->push($callable, $name);

        return $this;
    }

    private function createHttpClient(): GuzzleClient
    {
        if (! $this->httpClient instanceof GuzzleClient) {
            $this->handlerStack->push(
                new ApplyCredentialToRequest($this->credential),
                ApplyCredentialToRequest::name()
            );

            $this->httpClient = new GuzzleClient([
                'handler' => $this->handlerStack,
            ]);
        }

        return $this->httpClient;
    }
}
