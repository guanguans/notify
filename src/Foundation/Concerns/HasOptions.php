<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
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
 * @mixin \Guanguans\Notify\Foundation\Message
 */
trait HasOptions
{
    /** @var array<string, (\Closure(OptionsResolver, \Symfony\Component\OptionsResolver\Options): void)|mixed> */
    protected array $defaults = [];

    /** @var list<string> */
    protected array $required = [];

    /** @var list<string> */
    protected array $defined = [];
    protected bool $ignoreUndefined = true;

    /** @var array<string, array{0: string, 1: string, 2?: (\Closure(\Symfony\Component\OptionsResolver\Options, mixed): string)|string}> */
    protected array $deprecated = [];

    // /** @var array<string, \Closure(\Symfony\Component\OptionsResolver\Options, mixed): mixed> */
    // protected array $normalizers = [];

    /** @var array<string, mixed> */
    protected array $allowedValues = [];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [];

    /** @var array<string, string> */
    protected array $infos = [];

    /** @var array<string, mixed> */
    protected array $options = [];

    /**
     * @param list<mixed> $arguments
     *
     * @throws \ReflectionException
     */
    public function __call(string $name, array $arguments): self
    {
        foreach (
            [
                static fn (string $name): string => $name,
                static fn (string $name): string => Str::snake($name),
                Str::pascal(...),
                Str::kebab(...),
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

    /**
     * @param array<string, mixed> $options
     */
    public function setOptions(array $options): self
    {
        $this->options = [...$this->options, ...$options];

        return $this;
    }

    public function getOption(string $option, mixed $default = null): mixed
    {
        return $this->options[$option] ?? $default;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    public function getValidatedOption(string $option, mixed $default = null): mixed
    {
        return $this->getValidatedOptions()[$option] ?? $default;
    }

    /**
     * @return array<string, mixed>
     */
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

    /**
     * @param array<string, mixed> $options
     *
     * @return array<string, mixed>
     */
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

    protected function preConfigureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        // // A prototype option can only be defined inside a nested option and during its resolution it will expect an array of arrays.
        // $optionsResolver->setPrototype($this->prototype);
        $optionsResolver->setDefaults([...$this->defaults, ...$this->defaults()]);

        // TODO: symfony/options-resolver:>=7.3 Refactor `configureOptionsResolver` to `nestedOptions`.
        if (method_exists($optionsResolver, 'setOptions')) {
            // @codeCoverageIgnoreStart
            $nestedOptions = $this->nestedOptions() + array_filter(
                $this->defaults(),
                static fn (mixed $default): bool => $default instanceof \Closure
            );

            foreach ($nestedOptions as $option => $nested) {
                $optionsResolver->setOptions($option, $nested);
            } // @codeCoverageIgnoreEnd
        }

        $optionsResolver->setRequired($this->required);
        $optionsResolver->setDefined($this->defined);
        $optionsResolver->setIgnoreUndefined($this->ignoreUndefined);

        $deprecated = [...$this->deprecated, ...$this->deprecated()];

        /** @var array<string, array{0: string, 1: string, 2?: (\Closure(\Symfony\Component\OptionsResolver\Options, mixed): string)|string}> $deprecated */
        foreach ($deprecated as $option => $arguments) {
            $optionsResolver->setDeprecated($option, ...$arguments);
        }

        foreach ($this->normalizers() as $option => $normalizer) {
            $optionsResolver->setNormalizer($option, $normalizer);
        }

        foreach ($this->allowedValues as $option => $allowedValue) {
            $optionsResolver->setAllowedValues($option, $allowedValue);
        }

        foreach ($this->allowedTypes as $option => $allowedType) {
            $optionsResolver->setAllowedTypes($option, $allowedType);
        }

        foreach ($this->infos as $option => $info) {
            $optionsResolver->setInfo($option, $info);
        }
    }

    /**
     * @return array<string, (\Closure(OptionsResolver $resolver, \Symfony\Component\OptionsResolver\Options $parent): void)|mixed>
     */
    protected function defaults(): array
    {
        return [];
    }

    /**
     * @return array<string, \Closure(OptionsResolver $resolver, \Symfony\Component\OptionsResolver\Options $parent): void>
     */
    protected function nestedOptions(): array
    {
        return []; // @codeCoverageIgnore
    }

    /**
     * @return array<string, array{0: string, 1: string, 2?: (\Closure(\Symfony\Component\OptionsResolver\Options, mixed): string)|string}>
     */
    protected function deprecated(): array
    {
        return [];
    }

    /**
     * @return array<string, \Closure(\Symfony\Component\OptionsResolver\Options, mixed): mixed>
     */
    protected function normalizers(): array
    {
        return [];
    }
}
