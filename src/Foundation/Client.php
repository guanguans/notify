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
use Guanguans\Notify\Foundation\Contracts\Message;
use Guanguans\Notify\Foundation\Credentials\NullCredential;
use Guanguans\Notify\Foundation\Traits\Conditionable;
use Guanguans\Notify\Foundation\Traits\HasHttpClient;
use Guanguans\Notify\Foundation\Traits\Macroable;
use Guanguans\Notify\Foundation\Traits\Tappable;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client implements Contracts\Client
{
    use Conditionable;
    use HasHttpClient, Macroable {
        HasHttpClient::__call as hasHttpClientCall;
        Macroable::__call as macroableCall;
    }
    use Tappable;

    private Credential $credential;

    public function __construct(?Credential $credential = null)
    {
        $this->credential = $credential ?? new NullCredential;
    }

    /**
     * @noinspection MissingReturnTypeInspection
     * @noinspection MissingParameterTypeDeclarationInspection
     *
     * @param mixed $name
     * @param mixed $arguments
     */
    public function __call($name, $arguments)
    {
        return static::hasMacro($name) ?
            $this->macroableCall($name, $arguments)
            : $this->hasHttpClientCall($name, $arguments);
    }

    /**
     * @return Response|ResponseInterface
     *
     * @throws GuzzleException
     *
     * @noinspection PhpSignatureMismatchDuringInheritanceInspection
     */
    public function send(Message $message): ResponseInterface
    {
        return $this->getHttpClient()->request(
            $message->toHttpMethod(),
            $message->toHttpUri(),
            $this->credential->applyToOptions($message->toHttpOptions())
        );
    }
}
