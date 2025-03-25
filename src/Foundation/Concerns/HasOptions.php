<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Concerns;

use Guanguans\Notify\Foundation\Exceptions\BadMethodCallException;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Foundation\Support\Str;
use Guanguans\Notify\Foundation\Support\Utils;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @property-read array<string, mixed> $defaults // Support nested options.
 * @property-read list<string> $required
 * @property-read list<string> $defined
 * @property-read bool $ignoreUndefined // Required symfony/options-resolver >= 6.3
 * @property-read array<array-key, array|string> $deprecated
 * @property-read array<string, \Closure> $normalizers
 * @property-read array<string, mixed> $allowedValues
 * @property-read array<string, list<string>|string> $allowedTypes;
 * @property-read array<string, string> $infos
 *
 * @method array<string, mixed> defaults() // Support nested options.
 * @method array<int|string, array|string> deprecated()
 * @method array<string, \Closure> normalizers()
 */
trait HasOptions
{
    protected array $options = [];

    /**
     * @throws \ReflectionException
     */
    public function __call(string $name, array $arguments): self
    {
        foreach (
            [
                static fn (string $name): string => $name,
                static fn (string $name): string => Str::snake($name),
                static fn (string $name): string => Str::pascal($name),
                static fn (string $name): string => Str::kebab($name),
            ] as $caster
        ) {
            if (!\in_array($castedName = $caster($name), $defined ??= Utils::definedFor($this), true)) {
                continue;
            }

            if (1 !== ($numberOfArguments = \count($arguments))) {
                throw new InvalidArgumentException(\sprintf(
                    'The method [%s::%s] only accepts 1 argument, %s given.',
                    static::class,
                    $name,
                    $numberOfArguments
                ));
            }

            return $this->setOption($castedName, $arguments[0]);
        }

        throw new BadMethodCallException(\sprintf('The method [%s::%s] does not exist.', static::class, $name));
    }

    public function setOption(string $option, mixed $value): self
    {
        $this->options[$option] = $value;

        return $this;
    }

    public function setOptions(array $options): self
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    public function getOption(string $option, mixed $default = null): mixed
    {
        return $this->options[$option] ?? $default;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getValidatedOption(string $option, mixed $default = null): mixed
    {
        return $this->getValidatedOptions()[$option] ?? $default;
    }

    public function getValidatedOptions(): array
    {
        return $this->configureAndResolveOptions($this->options, function (OptionsResolver $optionsResolver): void {
            $this->preConfigureOptionsResolver($optionsResolver);
            $this->configureOptionsResolver($optionsResolver);
        });
    }

    /**
     * @param array-key $offset
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->options[$offset]);
    }

    /**
     * @param array-key $offset
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->getOption($offset);
    }

    /**
     * @param array-key $offset
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->setOption($offset, $value);
    }

    /**
     * @param array-key $offset
     */
    public function offsetUnset(mixed $offset): void
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
        // Configure options resolver...
    }

    private function preConfigureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefaults(array_merge(
            property_exists($this, 'defaults') ? $this->defaults : [],
            method_exists($this, 'defaults') ? $this->defaults() : [],
        ));

        property_exists($this, 'required') and $optionsResolver->setRequired($this->required);
        property_exists($this, 'defined') and $optionsResolver->setDefined($this->defined);

        // // A prototype option can only be defined inside a nested option and during its resolution it will expect an array of arrays.
        // property_exists($this, 'prototype') and $optionsResolver->setPrototype($this->prototype);

        // Required symfony/options-resolver >= 6.3
        if (property_exists($this, 'ignoreUndefined') && method_exists($optionsResolver, 'setIgnoreUndefined')) {
            $optionsResolver->setIgnoreUndefined($this->ignoreUndefined); // @codeCoverageIgnore
        }

        $deprecated = array_merge(
            property_exists($this, 'deprecated') ? $this->deprecated : [],
            method_exists($this, 'deprecated') ? $this->deprecated() : [],
        );

        foreach ($deprecated as $option => $arguments) {
            // Required symfony/options-resolver < 6.0
            \is_string($arguments) and $arguments = [$arguments];

            \is_string($option) and array_unshift($arguments, $option);

            $optionsResolver->setDeprecated(...array_pad($arguments, 3, ''));
        }

        $normalizers = array_merge(
            property_exists($this, 'normalizers') ? $this->normalizers : [],
            method_exists($this, 'normalizers') ? $this->normalizers() : [],
        );

        foreach ($normalizers as $option => $normalizer) {
            $optionsResolver->setNormalizer($option, $normalizer);
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
