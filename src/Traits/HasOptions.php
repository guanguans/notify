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

        foreach ($this->allowedTypes as $option => $allowedType) {
            $resolver->setAllowedTypes($option, $allowedType);
        }

        foreach ($this->allowedValues as $option => $allowedValue) {
            $resolver->setAllowedValues($option, $allowedValue);
        }

        return $resolver;
    }

    /**
     * @return $this
     */
    public function setOptions(array $options)
    {
        return $this->addOptions($options);
    }

    /**
     * @return $this
     */
    public function addOptions(array $options)
    {
        $resolver = $this->configureOptionsResolver($this->createOptionsResolver());

        $this->options = array_merge($this->options, $resolver->resolve($options));

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
    public function setOption(string $key, $value)
    {
        $this->setOptions([$key => $value]);

        return $this;
    }
}
