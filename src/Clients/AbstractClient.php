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
use Guanguans\Notify\Support\Str;
use Guanguans\Notify\Traits\HasHttpClient;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractClient implements GatewayInterface, MessageInterface, RequestInterface
{
    use HasHttpClient;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var string
     */
    protected $format = 'urlencoded';

    /**
     * AbstractClient constructor.
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    public function getName(): string
    {
        return str_replace([__NAMESPACE__.'\\', 'Client'], '', get_class($this));
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'access_token',
                'content',
            ]);
            $resolver->setAllowedTypes('access_token', 'string');
            $resolver->setAllowedTypes('content', 'string');
        });

        $this->options = array_merge($this->options, $diffOptions);
        foreach ($this->options as $key => $value) {
            $property = Str::camel($key);
            property_exists($this, $property) && $this->{$property} = $value;
        }

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setOption(string $key, $value): self
    {
        $this->setOptions([$key => $value]);

        return $this;
    }

    protected function getPropertyNameBySetMethod(string $setMethodName): string
    {
        return Str::snake(ltrim($setMethodName, 'set'));
    }

    abstract public function send();
}
