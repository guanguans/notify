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

/**
 * @see https://github.com/laravel/framework/blob/10.x/src/Illuminate/Macroable/Traits/Macroable.php
 */
trait Macroable
{
    /**
     * The registered string macros.
     */
    protected static array $macros = [];

    /**
     * Dynamically handle calls to the class.
     *
     * @throws \BadMethodCallException
     */
    public static function __callStatic(string $method, array $parameters)
    {
        if (! static::hasMacro($method)) {
            throw new \BadMethodCallException(sprintf('Method %s::%s does not exist.', static::class, $method));
        }

        $macro = static::$macros[$method];

        if ($macro instanceof \Closure) {
            $macro = $macro->bindTo(null, static::class);
        }

        return $macro(...$parameters);
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @throws \BadMethodCallException
     */
    public function __call(string $method, array $parameters)
    {
        if (! static::hasMacro($method)) {
            throw new \BadMethodCallException(sprintf('Method %s::%s does not exist.', static::class, $method));
        }

        $macro = static::$macros[$method];

        if ($macro instanceof \Closure) {
            $macro = $macro->bindTo($this, static::class);
        }

        return $macro(...$parameters);
    }

    /**
     * Register a custom macro.
     *
     * @param callable|object $macro
     */
    public static function macro(string $name, $macro): void
    {
        static::$macros[$name] = $macro;
    }

    /**
     * Mix another object into the class.
     *
     * @throws \ReflectionException
     */
    public static function mixin(object $mixin, bool $replace = true): void
    {
        $methods = (new \ReflectionClass($mixin))->getMethods(
            \ReflectionMethod::IS_PUBLIC | \ReflectionMethod::IS_PROTECTED
        );

        foreach ($methods as $method) {
            if ($replace || ! static::hasMacro($method->name)) {
                static::macro($method->name, $method->invoke($mixin));
            }
        }
    }

    /**
     * Checks if macro is registered.
     */
    public static function hasMacro(string $name): bool
    {
        return isset(static::$macros[$name]);
    }

    /**
     * Flush the existing macros.
     */
    public static function flushMacros(): void
    {
        static::$macros = [];
    }
}
