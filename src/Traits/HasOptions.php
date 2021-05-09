<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Traits;

use Symfony\Component\OptionsResolver\OptionsResolver;

trait HasOptions
{
    /**
     * @var OptionsResolver
     */
    protected static $resolver;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @return \Symfony\Component\OptionsResolver\OptionsResolver
     */
    protected function createOptionsResolver()
    {
        if (static::$resolver instanceof OptionsResolver) {
            return static::$resolver;
        }

        return static::$resolver = new OptionsResolver();
    }

    /**
     * @return $this
     */
    protected function configureOptionsResolver()
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        return $this->addOptions($options);
    }

    /**
     * @return $this
     */
    public function addOptions(array $options): self
    {
        $this->createOptionsResolver();

        $this->configureOptionsResolver();

        $this->options = array_merge($this->options, static::$resolver->resolve($options));

        return $this;
    }

    /**
     * @return array|mixed
     */
    public function getOptions(string $key = null)
    {
        if (is_null($key)) {
            return $this->options;
        }

        return $this->options[$key];
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
}
