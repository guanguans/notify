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

use Guanguans\Notify\Foundation\Concerns\Tappable;
use Guanguans\Notify\Foundation\Contracts\Credential;
use Guanguans\Notify\Foundation\Contracts\Message;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    use Tappable;

    private Credential $credential;
    private ClientInterface $httpClient;

    public function __construct(Credential $credential = null, ClientInterface $httpClient = null)
    {
        $this->credential = $credential ?? new NullCredential();
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendMessage(Message $message): ResponseInterface
    {
        return $this->httpClient->sendRequest(
            $this->credential->applyToRequest($message->toRequest())
        );
    }
}
