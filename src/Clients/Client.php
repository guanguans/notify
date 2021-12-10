<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Guanguans\Notify\Contracts\GatewayInterface;
use Guanguans\Notify\Contracts\MessageInterface;
use Guanguans\Notify\Contracts\RequestInterface;
use Guanguans\Notify\Messages\Message;
use Guanguans\Notify\Traits\HasHttpClient;
use Guanguans\Notify\Traits\HasOptions;

abstract class Client implements GatewayInterface, RequestInterface
{
    use HasHttpClient;
    use HasOptions;

    /**
     * @var string
     */
    protected $requestMethod = 'post';

    /**
     * @var bool
     */
    protected $requestAsync = false;

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
    ];

    /**
     * @var array
     */
    protected $sendingCallbacks = [];

    /**
     * @var array
     */
    protected $sendedCallbacks = [];

    /**
     * @var \Psr\Http\Message\ResponseInterface|\Overtrue\Http\Support\Collection|array|object|string
     */
    protected $response;

    /**
     * Client constructor.
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    public function getName(): string
    {
        return str_replace([__NAMESPACE__.'\\', 'Client'], '', get_class($this));
    }

    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    public function getToken(): string
    {
        return $this->getOption('token');
    }

    /**
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->setOption('token', $token);

        return $this;
    }

    public function getMessage(): Message
    {
        return $this->getOption('message');
    }

    /**
     * @return $this
     */
    public function setMessage(MessageInterface $message): self
    {
        $this->setOption('message', $message);

        return $this;
    }

    public function isRequestAsync(): bool
    {
        return $this->requestAsync;
    }

    public function setRequestAsync(bool $requestAsync): self
    {
        $this->requestAsync = $requestAsync;

        return $this;
    }

    /**
     * @return array|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     */
    public function getResponse()
    {
        return $this->response;
    }

    public function getRequestParams(): array
    {
        return $this->getMessage()->transformToRequestParams();
    }

    public function sending(callable $callback): self
    {
        $this->sendingCallbacks[] = $callback;

        return $this;
    }

    public function sended(callable $callback): self
    {
        $this->sendedCallbacks[] = $callback;

        return $this;
    }

    protected function callSendingCallbacks()
    {
        foreach ($this->sendingCallbacks as $callback) {
            call_user_func($callback, $this);
        }
    }

    protected function callSendedCallbacks()
    {
        foreach ($this->sendedCallbacks as $callback) {
            call_user_func($callback, $this);
        }
    }

    public function send(MessageInterface $message = null)
    {
        $message and $this->setMessage($message);

        $this->callSendingCallbacks();

        $response = $this->getHttpClient()
            ->{$this->getRequestMethod()}(
                $this->getRequestUrl(),
                $this->getRequestParams(),
                [],
                $this->requestAsync
            );

        $this->requestAsync and $response = $response->wait();

        $this->response = $response;

        $this->callSendedCallbacks();

        return $response;
    }
}
