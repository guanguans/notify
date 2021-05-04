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
use Guanguans\Notify\Contracts\RequestInterface;
use Guanguans\Notify\Traits\HasHttpClient;
use Guanguans\Notify\Traits\HasOptions;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractClient implements GatewayInterface, RequestInterface
{
    use HasHttpClient;
    use HasOptions;

    /**
     * AbstractClient constructor.
     */
    public function __construct(array $options = [])
    {
        $this->initOptions($this->initOptions);
        $this->setOptions($options);
    }

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'token',
                'message',
            ]);
            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('message', 'object');
        });

        $this->options = array_merge($this->options, $diffOptions);

        return $this;
    }

    public function getName(): string
    {
        return str_replace([__NAMESPACE__.'\\', 'Client'], '', get_class($this));
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

    abstract public function send($message = null);
}
