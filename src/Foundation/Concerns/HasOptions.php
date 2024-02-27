<?php

/** @noinspection MissingReturnTypeInspection */
/** @noinspection MissingParameterTypeDeclarationInspection */

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Concerns;

use Guanguans\Notify\Foundation\Exceptions\BadMethodCallException;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Foundation\Support\Str;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @property-read array<string, mixed> $defaults // Support nested options.
 * @property-read array<string> $required
 * @property-read array<string> $defined
 * @property-read array<array-key, array|string> $deprecated
 * @property-read array<string, \Closure> $normalizers
 * @property-read array<string, mixed> $allowedValues
 * @property-read array<string, array<string>|string> $allowedTypes;
 * @property-read array<string, string> $infos
 */
trait HasOptions
{
    protected array $options = [];

    public function __call($name, $arguments)
    {
        $defined = $this->defined ?? [];

        foreach ([null, 'snake', 'pascal'] as $case) {
            $casedName = $case ? Str::{$case}($name) : $name;
            if (\in_array($casedName, $defined, true)) {
                if (empty($arguments)) {
                    throw new InvalidArgumentException(
                        sprintf('The method [%s::%s] require an argument.', static::class, $name)
                    );
                }

                return $this->setOption($casedName, $arguments[0]);
            }
        }

        throw new BadMethodCallException(sprintf('The method [%s::%s] does not exist.', static::class, $name));
    }

    public function setOptions(array $options): self
    {
        foreach ($options as $option => $value) {
            $this->setOption($option, $value);
        }

        return $this;
    }

    public function setOption(string $option, $value): self
    {
        $this->options[$option] = $value;

        return $this;
    }

    public function getOption(string $option, $default = null)
    {
        return $this->getOptions()[$option] ?? $default;
    }

    public function getOptions(): array
    {
        return $this->configureAndResolveOptions($this->options, function (OptionsResolver $optionsResolver): void {
            $this->preConfigureOptionsResolver($optionsResolver);
            $this->configureOptionsResolver($optionsResolver);
        });
    }

    public function offsetExists($offset): bool
    {
        return isset($this->options[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->getOptions()[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->setOption($offset, $value);
    }

    public function offsetUnset($offset): void
    {
        unset($this->options[$offset]);
    }

    protected function configureAndResolveOptions(array $options, callable $callback): array
    {
        $optionsResolver = new OptionsResolver;

        $callback($optionsResolver);

        return $optionsResolver->resolve($options);
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        // configure options resolver...
    }

    private function preConfigureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        property_exists($this, 'defaults') and $optionsResolver->setDefaults($this->defaults);
        property_exists($this, 'required') and $optionsResolver->setRequired($this->required);
        property_exists($this, 'defined') and $optionsResolver->setDefined($this->defined);

        // // A prototype option can only be defined inside a nested option and during its resolution it will expect an array of arrays.
        // property_exists($this, 'prototype') and $optionsResolver->setPrototype($this->prototype);

        if (property_exists($this, 'deprecated')) {
            foreach ($this->deprecated as $option => $arguments) {
                // \is_string($arguments) and $arguments = [$arguments];
                // \is_string($option) and array_unshift($arguments, $option);

                // compatible with Symfony 5.4
                array_unshift($arguments, $option);

                $optionsResolver->setDeprecated(...$arguments);
            }
        }

        if (property_exists($this, 'normalizers')) {
            foreach ($this->normalizers as $option => $normalizer) {
                $optionsResolver->setNormalizer($option, $normalizer);
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

        if (property_exists($this, 'infos')) {
            foreach ($this->infos as $option => $info) {
                $optionsResolver->setInfo($option, $info);
            }
        }
    }
}
