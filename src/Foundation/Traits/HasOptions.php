<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Traits;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @property array $defined;
 * @property array $required;
 * @property array $deprecated;
 * @property array $defaults;
 * @property bool  $prototype;
 * @property array $allowedValues;
 * @property array $allowedTypes;
 * @property array $normalizers;
 * @property array $infos;
 */
trait HasOptions
{
    protected array $options = [];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        // configure options resolver...
        return $optionsResolver;
    }

    private function configureAndResolveOptions(array $options, callable $configurator): array
    {
        $resolver = new OptionsResolver();

        $configurator($resolver);

        return $resolver->resolve($options);
    }

    private function preConfigureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        property_exists($this, 'defined') and $optionsResolver->setDefined($this->defined);
        property_exists($this, 'required') and $optionsResolver->setRequired($this->required);
        property_exists($this, 'defaults') and $optionsResolver->setDefaults($this->defaults);
        property_exists($this, 'prototype') and $optionsResolver->setPrototype($this->prototype);

        if (property_exists($this, 'deprecated')) {
            foreach ($this->deprecated as $option => $deprecated) {
                array_unshift($deprecated, $option);
                $optionsResolver->setDeprecated(...$deprecated);
            }
        }

        if (property_exists($this, 'allowedValues')) {
            foreach ($this->allowedValues as $option => $allowedValue) {
                $optionsResolver->setAllowedValues($option, $allowedValue);
            }
        }

        if (property_exists($this, 'allowedTypes')) {
            foreach ($this->allowedTypes as $option => $allowedType) {
                $optionsResolver->setAllowedTypes($option, $allowedType);
            }
        }

        if (property_exists($this, 'normalizers')) {
            foreach ($this->normalizers as $option => $normalizer) {
                $optionsResolver->setNormalizer($option, $normalizer);
            }
        }

        if (property_exists($this, 'infos')) {
            foreach ($this->infos as $option => $info) {
                $optionsResolver->setInfo($option, $info);
            }
        }

        return $optionsResolver;
    }

    public function setOptions(array $options): self
    {
        $this->options = array_replace_recursive($this->options, $options);

        return $this;
    }

    public function setOption(string $option, $value): self
    {
        return $this->setOptions([$option => $value]);
    }

    public function getOption(string $option, $default = null)
    {
        return $this->getOptions()[$option] ?? $default;
    }

    public function getOptions(): array
    {
        return $this->options = $this->configureAndResolveOptions($this->options, function (OptionsResolver $optionsResolver): void {
            $this->configureOptionsResolver($this->preConfigureOptionsResolver($optionsResolver));
        });
    }

    public function __get($option)
    {
        return $this->offsetGet($option);
    }

    public function __set($option, $value)
    {
        $this->offsetSet($option, $value);
    }

    public function __isset($option)
    {
        return $this->offsetExists($option);
    }

    public function __unset($option)
    {
        $this->offsetUnset($option);
    }

    public function offsetExists($offset)
    {
        return isset($this->options[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->getOption($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->setOption($offset, $value);
    }

    public function offsetUnset($offset)
    {
        unset($this->options[$offset]);
    }
}
