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

trait Conditionable
{
    /**
     * Apply the callback if the given "value" is (or resolves to) truthy.
     *
     * @template TWhenParameter
     * @template TWhenReturnType
     *
     * @param (\Closure($this): TWhenParameter)|TWhenParameter|null   $value
     * @param (callable($this, TWhenParameter): TWhenReturnType)|null $callback
     * @param (callable($this, TWhenParameter): TWhenReturnType)|null $default
     *
     * @return $this|TWhenReturnType
     */
    public function when($value = null, callable $callback = null, callable $default = null)
    {
        $value = $value instanceof \Closure ? $value($this) : $value;

        if ($value) {
            return $callback($this, $value) ?? $this;
        } elseif ($default) {
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
     * @param (\Closure($this): TUnlessParameter)|TUnlessParameter|null   $value
     * @param (callable($this, TUnlessParameter): TUnlessReturnType)|null $callback
     * @param (callable($this, TUnlessParameter): TUnlessReturnType)|null $default
     *
     * @return $this|TUnlessReturnType
     */
    public function unless($value = null, callable $callback = null, callable $default = null)
    {
        $value = $value instanceof \Closure ? $value($this) : $value;

        if (! $value) {
            return $callback($this, $value) ?? $this;
        } elseif ($default) {
            return $default($this, $value) ?? $this;
        }

        return $this;
    }
}
