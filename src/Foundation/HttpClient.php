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

use Guanguans\Notify\Foundation\Concerns\CreatesDefaultHttpClient;
use Guanguans\Notify\Foundation\Concerns\Tappable;
use Guanguans\Notify\Foundation\Contracts\Credential;
use Guanguans\Notify\Foundation\Middleware\ApplyCredentialToRequest;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    use Tappable;
    use CreatesDefaultHttpClient;

    private Credential $credential;

    public function __construct(Credential $credential = null)
    {
        $this->credential = $credential ?? new NullCredential();
    }

    /**
     * @throws GuzzleException
     */
    public function send(HttpMessage $httpMessage): ResponseInterface
    {
        return $this
            ->pushMiddleware((new ApplyCredentialToRequest($this->credential))(), ApplyCredentialToRequest::name())
            ->createDefaultHttClient([])
            ->request($httpMessage->method(), $httpMessage->uri(), $httpMessage->options());
    }
}
