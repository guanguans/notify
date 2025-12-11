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

namespace Guanguans\Notify\Foundation\Caches;

use Psr\SimpleCache\CacheInterface;

/**
 * @see https://github.com/algolia/algoliasearch-client-php/blob/main/lib/Cache/NullCacheDriver.php
 * @see https://github.com/pestphp/pest-plugin-mutate/blob/4.x/src/Cache/FileStore.php
 * @see https://github.com/pestphp/pest-plugin-mutate/blob/4.x/src/Cache/NullStore.php
 * @see https://github.com/php-cache/void-adapter/blob/master/VoidCachePool.php
 * @see https://github.com/PHPOffice/PhpSpreadsheet/blob/master/src/PhpSpreadsheet/Collection/Memory/SimpleCache1.php
 * @see https://github.com/PHPOffice/PhpSpreadsheet/blob/master/src/PhpSpreadsheet/Collection/Memory/SimpleCache3.php
 * @see https://github.com/serbanghita/Mobile-Detect/blob/4.8.x/src/Cache/Cache.php
 * @see https://github.com/SpartnerNL/Laravel-Excel/blob/3.1/src/Cache/BatchCache.php
 * @see https://github.com/SpartnerNL/Laravel-Excel/blob/3.1/src/Cache/MemoryCache.php
 * @see https://github.com/cakephp/cache
 * @see https://github.com/codeigniter4/cache
 * @see https://github.com/spiral/cache
 * @see https://github.com/yiisoft?q=cache&type=all&language=&sort=
 */
class NullCache implements CacheInterface
{
    public function get(string $key, mixed $default = null): mixed
    {
        return $default;
    }

    public function set(string $key, mixed $value, null|\DateInterval|int $ttl = null): bool
    {
        return true;
    }

    public function delete(string $key): bool
    {
        return true;
    }

    public function clear(): bool
    {
        return true;
    }

    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        $result = [];

        foreach ($keys as $key) {
            $result[$key] = $default;
        }

        return $result;
    }

    /**
     * @param iterable<string, mixed> $values
     */
    public function setMultiple(iterable $values, null|\DateInterval|int $ttl = null): bool
    {
        return true;
    }

    /**
     * @param iterable<string> $keys
     */
    public function deleteMultiple(iterable $keys): bool
    {
        return true;
    }

    public function has(string $key): bool
    {
        return false;
    }
}
