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
use Guanguans\Notify\Exceptions\Exception;
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
     * AbstractClient constructor.
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @return $this
     */
    protected function configureOptionsResolver()
    {
        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'token',
                'message',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('message', 'object');
        });

        return $this;
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
        return $this->options['token'];
    }

    /**
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->setOption('token', $token);

        return $this;
    }

    public function getMessage(): object
    {
        return $this->getOptions('message');
    }

    /**
     * @return $this
     */
    public function setMessage($message): self
    {
        $this->setOption('message', $message);

        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getRequestParams(): array
    {
        if (empty($this->getMessage())) {
            throw new Exception('No Message!');
        }

        if (! $this->getMessage() instanceof Message) {
            throw new Exception(sprintf('The message no instanceof %s', Message::class));
        }

        return $this->getMessage()->transformToRequestParams();
    }

    public function send(MessageInterface $message = null)
    {
        $message && $this->setMessage($message);

        return $this->getHttpClient()->{$this->getRequestMethod()}($this->getRequestUrl(), $this->getRequestParams());
    }
}
