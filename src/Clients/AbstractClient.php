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
use Guanguans\Notify\Traits\HasHttpClient;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractClient implements GatewayInterface, MessageInterface, RequestInterface
{
    use HasHttpClient;

    protected $options = [];

    /**
     * AbstractClient constructor.
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '\\'.get_class($this);
    }

    /**
     * @return false|string|string[]
     */
    public function getShortName()
    {
        return str_replace([__NAMESPACE__.'\\', 'Client'], '', \get_class($this));
    }

    public function setOptions(array $options)
    {
        $this->options = configure_options(array_merge($this->options, $options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'token',
                'content',
            ]);
            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('content', 'string');
        });

        foreach ($this->options as $key => $value) {
            property_exists($this, $key) && $this->{$key} = $value;
        }

        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOption($key, $value)
    {
        $this->setOptions([
            $key => $value,
        ]);

        return $this;
    }

    abstract public function send();
}
