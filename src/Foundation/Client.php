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

use Guanguans\Notify\Foundation\Authenticators\NullAuthenticator;
use Guanguans\Notify\Foundation\Contracts\Authenticator;
use Guanguans\Notify\Foundation\Contracts\Message;
use Guanguans\Notify\Foundation\Traits\Conditionable;
use Guanguans\Notify\Foundation\Traits\HasHttpClient;
use Guanguans\Notify\Foundation\Traits\Makeable;
use Guanguans\Notify\Foundation\Traits\Tappable;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client implements Contracts\Client
{
    use Conditionable;
    use HasHttpClient;
    use Makeable;
    use Tappable;

    private Authenticator $authenticator;

    public function __construct(?Authenticator $authenticator = null)
    {
        $this->authenticator = $authenticator ?? new NullAuthenticator;
    }

    /**
     * @return Response|ResponseInterface
     *
     * @throws GuzzleException
     */
    public function send(Message $message): ResponseInterface
    {
        return $this->getHttpClient()->request(
            $message->toHttpMethod(),
            $message->toHttpUri(),
            $this->authenticator->applyToOptions($message->toHttpOptions())
        );
    }
}
