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
use Guanguans\Notify\Foundation\Traits\HasHttpClient;
use Guanguans\Notify\Foundation\Traits\Tappable;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client implements Contracts\Client
{
    use Tappable;
    use HasHttpClient;

    private Credential $credential;

    public function __construct(Credential $credential = null)
    {
        $this->credential = $credential ?? new NullCredential();
    }

    /**
     * @throws GuzzleException
     */
    public function send(Contracts\Message $message): ResponseInterface
    {
        return ($this->getHttpClientResolver())()->request(
            $message->httpMethod(),
            $message->httpUri(),
            $this->credential->applyToOptions($message->toHttpOptions())
        );
    }
}
