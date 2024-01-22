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
use Guanguans\Notify\Foundation\Middleware\ApplyCredentialToRequest;
use Guanguans\Notify\Foundation\Traits\Tappable;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\ResponseInterface;

class Client implements Contracts\Client
{
    use Tappable;

    private Credential $credential;
    private ?\GuzzleHttp\Client $httpClient;

    public function __construct(Credential $credential = null, \GuzzleHttp\Client $httpClient = null)
    {
        $this->credential = $credential ?? new NullCredential();
        $this->httpClient = $httpClient ?? new \GuzzleHttp\Client([
            'handler' => (function (): HandlerStack {
                $handlerStack = HandlerStack::create();
                $handlerStack->push(new ApplyCredentialToRequest($this->credential), ApplyCredentialToRequest::name());

                return $handlerStack;
            })(),
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function send(Contracts\Message $message): ResponseInterface
    {
        return $this
            ->httpClient
            ->request(
                $message->httpMethod(),
                $message->httpUri(),
                $this->credential->applyToOptions($message->toHttpOptions())
            );
    }
}
