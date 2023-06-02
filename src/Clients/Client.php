<?php

declare(strict_types=1);

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
use Guanguans\Notify\Traits\CreateStaticable;
use Guanguans\Notify\Traits\HasHttpClient;
use Guanguans\Notify\Traits\HasOptions;

abstract class Client implements GatewayInterface, RequestInterface
{
    use HasHttpClient;
    use HasOptions;
    use CreateStaticable;

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
     * @var \Psr\Http\Message\ResponseInterface|\Overtrue\Http\Support\Collection|array|object|string|null
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

    /**
     * @return \Guanguans\Notify\Contracts\MessageInterface|\Symfony\Component\Mime\RawMessage|\Guanguans\Notify\Messages\Message
     */
    public function getMessage(): MessageInterface
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
     * @return array|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string|null
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
        foreach ($this->sendingCallbacks as $sendingCallback) {
            call_user_func($sendingCallback, $this);
        }
    }

    protected function callSendedCallbacks()
    {
        foreach ($this->sendedCallbacks as $sendedCallback) {
            call_user_func($sendedCallback, $this);
        }
    }

    protected function wrapSendCallbacks(\Closure $handler)
    {
        $this->callSendingCallbacks();

        $handled = $handler();

        $this->callSendedCallbacks();

        return $handled;
    }

    protected function wrapSendCallbacksWithRequestAsync(\Closure $handler)
    {
        return $this->wrapSendCallbacks(function () use ($handler) {
            $handled = $handler();

            $this->requestAsync and $handled = $handled->wait();

            $this->response = $handled;

            return $handled;
        });
    }

    public function send(MessageInterface $message = null)
    {
        $message and $this->setMessage($message);

        return $this->wrapSendCallbacksWithRequestAsync(function () {
            return $this->getHttpClient()
                ->{$this->getRequestMethod()}(
                    $this->getRequestUrl(),
                    $this->getRequestParams(),
                    [],
                    $this->requestAsync
                );
        });
    }
}
