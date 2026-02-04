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

namespace Guanguans\Notify\Foundation\Caches;

use Guanguans\Notify\Foundation\Exceptions\CacheInvalidArgumentException;
use Psr\SimpleCache\CacheInterface;

/**
 * @see https://github.com/serbanghita/Mobile-Detect/blob/4.8.x/src/Cache/Cache.php
 */
class MemoryCache implements CacheInterface
{
    protected array $cache = [];

    /**
     * {@inheritDoc}
     *
     * @throws \Guanguans\Notify\Foundation\Exceptions\CacheInvalidArgumentException
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $this->checkKey($key);

        if (isset($this->cache[$key])) {
            if (null === $this->cache[$key]['ttl'] || time() < $this->cache[$key]['ttl']) {
                return $this->cache[$key]['content'];
            }

            // @Note: this is an interpretation of "Definitions" -> "Expiration"
            // Implementing Libraries MAY expire an item before its requested Expiration Time, but MUST treat an item as expired once its Expiration Time is reached.
            $this->deleteSingle($key);
        }

        return $default;
    }

    /**
     * {@inheritDoc}
     *
     * @throws \Guanguans\Notify\Foundation\Exceptions\CacheInvalidArgumentException
     */
    public function set(string $key, mixed $value, null|\DateInterval|int $ttl = null): bool
    {
        $this->checkKey($key);

        // From https://www.php-fig.org/psr/psr-16/ "Definitions" -> "Expiration"
        // If a negative or zero TTL is provided, the item MUST be deleted from the cache if it exists, as it is expired already.
        if (\is_int($ttl) && 0 >= $ttl) {
            $this->deleteSingle($key);

            return false;
        }

        $ttl = $this->getTTL($ttl);

        if (null !== $ttl) {
            $ttl = time() + $ttl;
        }

        $this->cache[$key] = ['ttl' => $ttl, 'content' => $value];

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $key): bool
    {
        $this->checkKey($key);
        $this->deleteSingle($key);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function clear(): bool
    {
        $this->cache = [];

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        $data = [];

        foreach ($keys as $key) {
            $data[$key] = $this->get($key, $default);
        }

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function setMultiple(iterable $values, null|\DateInterval|int $ttl = null): bool
    {
        $return = [];

        foreach ($values as $key => $value) {
            $return[] = $this->set($key, $value, $ttl);
        }

        return $this->checkReturn($return);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteMultiple(iterable $keys): bool
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $key): bool
    {
        $key = $this->checkKey($key);

        return isset($this->cache[$key]);
    }

    /**
     * Get all cache keys.
     *
     * @internal needed for testing purposes
     *
     * @return list<string>
     */
    public function getKeys(): array
    {
        return array_keys($this->cache);
    }

    /**
     * @throws \Guanguans\Notify\Foundation\Exceptions\CacheInvalidArgumentException
     */
    protected function checkKey(string $key): string
    {
        if ('' === $key || !preg_match('/^[A-Za-z0-9_.]{1,256}$/', $key)) {
            throw new CacheInvalidArgumentException("Invalid key: '$key'. Must be alphanumeric, can contain _ and . and can be maximum of 256 chars.");
        }

        return $key;
    }

    protected function getTTL(null|\DateInterval|int $ttl): ?int
    {
        if ($ttl instanceof \DateInterval) {
            return (new \DateTimeImmutable)->add($ttl)->getTimeStamp() - time();
        }

        // We treat 0 as a valid value.
        if (\is_int($ttl)) {
            return $ttl;
        }

        return null;
    }

    /**
     * Checks if at least one of the values is FALSE, then returns FALSE.
     *
     * @param list<bool> $booleans
     */
    protected function checkReturn(array $booleans): bool
    {
        return !\in_array(false, $booleans, true);
    }

    /**
     * Deletes the cache item from memory.
     *
     * @param string $key Cache key
     */
    private function deleteSingle(string $key): void
    {
        unset($this->cache[$key]);
    }
}
