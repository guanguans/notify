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
 * @see https://github.com/pestphp/pest-plugin-mutate/blob/4.x/src/Cache/FileStore.php
 */
class FileCache implements CacheInterface
{
    /** @var string */
    private const CACHE_FOLDER_NAME = 'notify-cache';

    /** @readonly */
    private string $directory;

    public function __construct(?string $directory = null)
    {
        $this->directory = $directory ?? (sys_get_temp_dir().\DIRECTORY_SEPARATOR.self::CACHE_FOLDER_NAME); // @pest-mutate-ignore

        if (!is_dir($this->directory)) { // @pest-mutate-ignore
            mkdir($this->directory, recursive: true);
        }
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->getPayload($key) ?? $default;
    }

    public function set(string $key, mixed $value, null|\DateInterval|int $ttl = null): bool
    {
        $payload = serialize($value);

        $expire = $this->expiration($ttl);

        $content = $expire.$payload;

        $result = file_put_contents($this->filePathFromKey($key), $content);

        return false !== $result; // @pest-mutate-ignore FalseToTrue
    }

    public function delete(string $key): bool
    {
        return unlink($this->filePathFromKey($key));
    }

    public function clear(): bool
    {
        foreach ((array) glob($this->directory.\DIRECTORY_SEPARATOR.'*') as $fileName) {
            // @pest-mutate-ignore
            if (false === $fileName) {
                continue;
            }

            if (!str_starts_with(basename($fileName), 'cache-')) {
                continue;
            }

            // @pest-mutate-ignore
            unlink($fileName);
        }

        return true;
    }

    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        $result = [];

        foreach ($keys as $key) {
            $result[$key] = $this->get($key, $default);
        }

        return $result;
    }

    /**
     * @param iterable<string, mixed> $values
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function setMultiple(iterable $values, null|\DateInterval|int $ttl = null): bool
    {
        $result = true;

        foreach ($values as $key => $value) {
            if (!$this->set($key, $value, $ttl)) {
                $result = false;
            }
        }

        return $result;
    }

    /**
     * @param iterable<string> $keys
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function deleteMultiple(iterable $keys): bool
    {
        $result = true;

        foreach ($keys as $key) {
            if (!$this->delete($key)) {
                $result = false;
            }
        }

        return $result;
    }

    public function has(string $key): bool
    {
        return file_exists($this->filePathFromKey($key));
    }

    public function directory(): string
    {
        return $this->directory;
    }

    protected function emptyPayload(): mixed
    {
        return null;
    }

    private function filePathFromKey(string $key): string
    {
        return $this->directory.\DIRECTORY_SEPARATOR.'cache-'.hash('md5', $key); // @pest-mutate-ignore
    }

    private function expiration(null|\DateInterval|int $seconds): int
    {
        if ($seconds instanceof \DateInterval) {
            return (new \DateTimeImmutable)->add($seconds)->getTimestamp();
        }

        $seconds ??= 0;

        if (0 === $seconds) {
            return 9_999_999_999; // @pest-mutate-ignore
        }

        return time() + $seconds;
    }

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    private function getPayload(string $key): mixed
    {
        if (!file_exists($this->filePathFromKey($key))) {
            return $this->emptyPayload();
        }

        $content = file_get_contents($this->filePathFromKey($key));

        if (false === $content) { // @pest-mutate-ignore
            return $this->emptyPayload();
        }

        try {
            $expire = (int) substr(
                $content,
                0,
                10
            );
        } catch (\Exception) {
            $this->delete($key);

            return $this->emptyPayload();
        }

        if (time() >= $expire) {
            $this->delete($key);

            return $this->emptyPayload();
        }

        try {
            $data = unserialize(substr($content, 10));
        } catch (\Exception) {
            $this->delete($key);

            return $this->emptyPayload();
        }

        return $data;
    }
}
