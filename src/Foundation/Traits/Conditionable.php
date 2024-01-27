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
 * @see https://github.com/laravel/framework/blob/10.x/src/Illuminate/Conditionable/Traits/Conditionable.php
 */
trait Conditionable
{
    /**
     * Apply the callback if the given "value" is (or resolves to) truthy.
     *
     * @template TWhenParameter
     * @template TWhenReturnType
     *
     * @param null|(\Closure($this): TWhenParameter)|TWhenParameter $value
     * @param null|(callable($this, TWhenParameter): TWhenReturnType) $callback
     * @param null|(callable($this, TWhenParameter): TWhenReturnType) $default
     *
     * @return $this|TWhenReturnType
     */
    public function when($value = null, ?callable $callback = null, ?callable $default = null)
    {
        $value = $value instanceof \Closure ? $value($this) : $value;

        if ($value) {
            return $callback($this, $value) ?? $this;
        }
        if ($default) {
            return $default($this, $value) ?? $this;
        }

        return $this;
    }

    /**
     * Apply the callback if the given "value" is (or resolves to) falsy.
     *
     * @template TUnlessParameter
     * @template TUnlessReturnType
     *
     * @param null|(\Closure($this): TUnlessParameter)|TUnlessParameter $value
     * @param null|(callable($this, TUnlessParameter): TUnlessReturnType) $callback
     * @param null|(callable($this, TUnlessParameter): TUnlessReturnType) $default
     *
     * @return $this|TUnlessReturnType
     */
    public function unless($value = null, ?callable $callback = null, ?callable $default = null)
    {
        $value = $value instanceof \Closure ? $value($this) : $value;

        if (! $value) {
            return $callback($this, $value) ?? $this;
        }
        if ($default) {
            return $default($this, $value) ?? $this;
        }

        return $this;
    }
}
