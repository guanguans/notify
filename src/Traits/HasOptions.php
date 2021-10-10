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
     * @var string[]
     */
    protected $defined = [];

    /**
     * @var string[]
     */
    protected $info = [];

    /**
     * @var array
     */
    protected $default = [];

    /**
     * @var string[]
     */
    protected $required = [];

    /**
     * @var array
     */
    protected $allowedTypes = [];

    /**
     * @var array
     */
    protected $allowedValues = [];

    protected function createOptionsResolver(): OptionsResolver
    {
        if (static::$resolver instanceof OptionsResolver) {
            return static::$resolver;
        }

        return static::$resolver = new OptionsResolver();
    }

    protected function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        $resolver->setDefined($this->defined);

        $resolver->setRequired($this->required);

        $resolver->setDefaults($this->default);

        foreach ($this->info as $option => $info) {
            $resolver->setInfo($option, $info);
        }

        foreach ($this->allowedTypes as $option => $allowedType) {
            $resolver->setAllowedTypes($option, $allowedType);
        }

        foreach ($this->allowedValues as $option => $allowedValue) {
            $resolver->setAllowedValues($option, $allowedValue);
        }

        return $resolver;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function addOption(string $option, $value)
    {
        $resolver = $this->configureOptionsResolver($this->createOptionsResolver());

        $this->options = array_merge($this->options, $resolver->resolve([$option => $value]));

        return $this;
    }

    /**
     * @return $this
     */
    public function addOptions(array $options)
    {
        foreach ($options as $option => $value) {
            $this->addOption($option, $value);
        }

        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setOption(string $option, $value)
    {
        return $this->addOption($option, $value);
    }

    /**
     * @return $this
     */
    public function setOptions(array $options)
    {
        return $this->addOptions($options);
    }

    /**
     * @return array|mixed
     */
    public function getOption(string $option = null)
    {
        if (is_null($option)) {
            return $this->options;
        }

        return $this->options[$option];
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function set(string $option, $value)
    {
        $this->setOption($option, $value);

        return $this;
    }

    /**
     * @return array|mixed
     */
    public function get(string $option = null)
    {
        return $this->getOption($option);
    }

    /**
     * @return bool
     */
    public function has(string $option)
    {
        return array_key_exists($option, $this->options);
    }

    /**
     * @param $option
     *
     * @return array|mixed
     */
    public function __get($option)
    {
        return $this->get($option);
    }

    /**
     * @param $option
     * @param $value
     *
     * @return $this
     */
    public function __set($option, $value)
    {
        return $this->set($option, $value);
    }

    /**
     * @param $option
     *
     * @return bool
     */
    public function __isset($option)
    {
        return isset($this->options[$option]);
    }
}
