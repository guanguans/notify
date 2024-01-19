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

use Guanguans\Notify\Foundation\Contracts\Client;
use Guanguans\Notify\Foundation\Contracts\Credential;
use Guanguans\Notify\Foundation\Traits\CreatesDefaultHttpClient;
use Guanguans\Notify\Foundation\Traits\Tappable;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClient implements Client
{
    use Tappable;
    use CreatesDefaultHttpClient;

    private Credential $credential;
    private array $httpOptions;

    public function __construct(Credential $credential = null, array $httpOptions = [])
    {
        $this->credential = $credential ?? new NullCredential();
        $this->httpOptions = $httpOptions;
    }

    /**
     * @return ResponseInterface|PromiseInterface
     *
     * @throws GuzzleException
     */
    public function send(Contracts\Message $message)
    {
        assert($message instanceof HttpMessage);

        return $this
            ->credential
            ->applyToClient($this)
            ->createDefaultHttClient($this->httpOptions)
            ->{$message->httpAsync() ? 'requestAsync' : 'request'}(
                $message->httpMethod(),
                $message->httpUri(),
                $message->httpOptions()
            );
    }
}
