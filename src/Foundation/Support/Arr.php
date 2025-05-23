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

namespace Guanguans\Notify\Foundation\Support;

class Arr
{
    /**
     * Determine whether the given value is array accessible.
     */
    public static function accessible(mixed $value): bool
    {
        return \is_array($value) || $value instanceof \ArrayAccess;
    }

    /**
     * Determine if the given key exists in the provided array.
     *
     * @param array-key|float $key
     */
    public static function exists(array|\ArrayAccess $array, mixed $key): bool
    {
        if ($array instanceof \ArrayAccess) {
            return $array->offsetExists($key);
        }

        if (\is_float($key)) {
            $key = (string) $key;
        }

        return \array_key_exists($key, $array);
    }

    /**
     * Set an array item to a given value using "dot" notation.
     *
     * If no key is given to the method, the entire array will be replaced.
     *
     * @param-out  array  $array
     *
     * @param null|array-key $key
     */
    public static function set(array &$array, mixed $key, mixed $value): array
    {
        if (null === $key) {
            return $array = $value;
        }

        $keys = explode('.', $key);

        /** @noinspection SuspiciousLoopInspection */
        foreach ($keys as $i => $key) {
            if (1 === \count($keys)) {
                break;
            }

            unset($keys[$i]);

            // If the key doesn't exist at this depth, we will just create an empty array
            // to hold the next value, allowing us to create the arrays to hold final
            // values at the correct depth. Then we'll keep digging into the array.
            if (!isset($array[$key]) || !\is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }

    /**
     * Get an item from an array using "dot" notation.
     *
     * @param array|\ArrayAccess|mixed $array
     * @param null|array-key $key
     */
    public static function get(mixed $array, mixed $key, mixed $default = null): mixed
    {
        if (!static::accessible($array)) {
            return value($default);
        }

        /** @var array|\ArrayAccess $array */
        if (null === $key) {
            return $array;
        }

        if (static::exists($array, $key)) {
            return $array[$key];
        }

        if (!str_contains($key, '.')) {
            return $array[$key] ?? value($default);
        }

        foreach (explode('.', $key) as $segment) {
            if (static::accessible($array) && static::exists($array, $segment)) {
                $array = $array[$segment];
            } else {
                return value($default);
            }
        }

        return $array;
    }

    /**
     * Run a map over each of the items in the array.
     */
    public static function map(array $array, callable $callback): array
    {
        $keys = array_keys($array);

        try {
            $items = array_map($callback, $array, $keys);
        } catch (\ArgumentCountError) {
            $items = array_map($callback, $array);
        }

        return array_combine($keys, $items);
    }

    /**
     * Get a subset of the items from the given array.
     *
     * @param array-key|list<array-key> $keys
     */
    public static function only(array $array, mixed $keys): array
    {
        return array_intersect_key($array, array_flip((array) $keys));
    }

    /**
     * Get all keys of the given array except for a specified array of keys.
     *
     * @param array-key|list<array-key> $keys
     */
    public static function except(array $array, mixed $keys): array
    {
        static::forget($array, $keys);

        return $array;
    }

    /**
     * Remove one or many array items from a given array using "dot" notation.
     *
     * @param-out array $array
     *
     * @param array-key|list<array-key> $keys
     */
    public static function forget(array &$array, mixed $keys): void
    {
        $original = &$array;

        $keys = (array) $keys;

        if ([] === $keys) {
            return;
        }

        foreach ($keys as $key) {
            // if the exact key exists in the top-level, remove it
            if (static::exists($array, $key)) {
                unset($array[$key]);

                continue;
            }

            $parts = explode('.', $key);

            // clean up before each pass
            $array = &$original;

            while (\count($parts) > 1) {
                $part = array_shift($parts);

                if (isset($array[$part]) && static::accessible($array[$part])) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }

            unset($array[array_shift($parts)]);
        }
    }

    /**
     * Reject the array recursively using a callback function.
     */
    public static function rejectRecursive(array $array, ?callable $callback = null, int $flag = 0): array
    {
        $callback ??= static fn (mixed ...$args): bool => (bool) $args[0];

        return static::filterRecursive($array, static fn (mixed ...$args): bool => !$callback(...$args), $flag);
    }

    /**
     * Filter the array recursively using a callback function.
     */
    public static function filterRecursive(array $array, ?callable $callback = null, int $flag = 0): array
    {
        foreach ($array as &$value) {
            if (\is_array($value)) {
                $value = static::filterRecursive($value, $callback, $flag);
            }
        }

        return array_filter($array, $callback, $flag);
    }
}
