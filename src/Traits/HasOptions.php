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
     * @var array<array-key, mixed>
     */
    protected $options = [];

    // protected $defined = [];
    // protected $required = [];
    // protected $deprecated = [];
    // protected $defaults = [];
    // protected $prototype = false;
    // protected $allowedValues = [];
    // protected $allowedTypes = [];
    // protected $normalizers = [];
    // protected $infos = [];

    public static function createOptionsResolver(): OptionsResolver
    {
        return new OptionsResolver();
    }

    protected function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        // configure options resolver...
        return $resolver;
    }

    protected function preConfigureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        property_exists($this, 'defined') and $resolver->setDefined($this->defined);
        property_exists($this, 'required') and $resolver->setRequired($this->required);
        property_exists($this, 'defaults') and $resolver->setDefaults((array) $this->defaults);
        property_exists($this, 'prototype') and $resolver->setPrototype((bool) $this->prototype);

        if (property_exists($this, 'deprecated')) {
            foreach ((array) $this->deprecated as $option => $deprecated) {
                array_unshift($deprecated, $option);
                $resolver->setDeprecated(...$deprecated);
            }
        }

        if (property_exists($this, 'allowedValues')) {
            foreach ((array) $this->allowedValues as $option => $allowedValue) {
                $resolver->setAllowedValues($option, $allowedValue);
            }
        }

        if (property_exists($this, 'allowedTypes')) {
            foreach ((array) $this->allowedTypes as $option => $allowedType) {
                $resolver->setAllowedTypes($option, $allowedType);
            }
        }

        if (property_exists($this, 'normalizers')) {
            foreach ((array) $this->normalizers as $option => $normalizer) {
                $resolver->setNormalizer($option, $normalizer);
            }
        }

        if (property_exists($this, 'infos')) {
            foreach ((array) $this->infos as $option => $info) {
                $resolver->setInfo($option, $info);
            }
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
        $this->addOptions([$option => $value]);

        return $this;
    }

    /**
     * @return $this
     */
    public function addOptions(array $options)
    {
        $resolver = $this->configureOptionsResolver(
            $this->preConfigureOptionsResolver(
                static::createOptionsResolver()
            )
        );

        $this->options = array_merge($this->options, $resolver->resolve($options));

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
