<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpVoidFunctionResultUsedInspection */
/** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

use Guanguans\Notify\Foundation\Caches\NullCache;

beforeEach(function (): void {
    $this->cache = new NullCache;
    $this->key = 'my-key';
});

it('always returns returns the default value when trying to load something from cache', function (): void {
    expect($this->cache->get($this->key, 'bar'))
        ->toBe('bar');

    expect($this->cache->get($this->key))
        ->toBeNull();

    $this->cache->set($this->key, 'foo');

    expect($this->cache->get($this->key, 'bar'))
        ->toBe('bar');
})->group(__DIR__, __FILE__);

it('always return true when adding a value', function (): void {
    expect($this->cache->set($this->key, 'foo'))
        ->toBeTrue();
})->group(__DIR__, __FILE__);

it('always return true when deleting a value', function (): void {
    expect($this->cache->delete($this->key))
        ->toBeTrue();
})->group(__DIR__, __FILE__);

it('always return true when clearing the cache', function (): void {
    expect($this->cache->clear())
        ->toBeTrue();
})->group(__DIR__, __FILE__);

it('always returns returns the default value when trying to load multiple values from cache', function (): void {
    expect($this->cache->getMultiple(['a', 'b'], 'bar'))
        ->toBe(['a' => 'bar', 'b' => 'bar']);

    expect($this->cache->getMultiple(['a', 'b']))
        ->toBe(['a' => null, 'b' => null]);

    $this->cache->set('a', 'foo');

    expect($this->cache->getMultiple(['a', 'b'], 'bar'))
        ->toBe(['a' => 'bar', 'b' => 'bar']);
})->group(__DIR__, __FILE__);

it('always return true when adding multiple values', function (): void {
    expect($this->cache->setMultiple(['a' => 'foo', 'b' => 'bar']))
        ->toBeTrue();
})->group(__DIR__, __FILE__);

it('always return true when deleting multiple values', function (): void {
    expect($this->cache->deleteMultiple(['a', 'b']))
        ->toBeTrue();
})->group(__DIR__, __FILE__);

it('always return false when checking if a value is in the cache', function (): void {
    expect($this->cache->has($this->key))
        ->toBeFalse();
})->group(__DIR__, __FILE__);
