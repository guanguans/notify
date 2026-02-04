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

use Guanguans\Notify\Foundation\Caches\MemoryCache;
use Guanguans\Notify\Foundation\Exceptions\CacheInvalidArgumentException;

beforeEach(function (): void {
    $this->memoryCache = new MemoryCache;
});

it('get invalid cache key throws exception', function (): void {
    $this->memoryCache->get('');
})->group(__DIR__, __FILE__)->throws(CacheInvalidArgumentException::class);

it('get expiring cache key with integer ttlis deleted', function (): void {
    $this->memoryCache->set('someKey', 'someValue', 1);
    sleep(1);
    expect($this->memoryCache->get('someKey'))->toBeNull();
})->group(__DIR__, __FILE__);

it('get expiring cache key with date interval ttlis deleted', function (): void {
    $this->memoryCache->set('someKey', 'someValue', new DateInterval('PT1S'));
    sleep(1);
    expect($this->memoryCache->get('someKey'))->toBeNull();
})->group(__DIR__, __FILE__);

it('set invalid cache key throws exception', function (): void {
    $this->memoryCache->set('', 'a', 100);
})->group(__DIR__, __FILE__)->throws(CacheInvalidArgumentException::class);

it('get non existent returns null', function (): void {
    expect($this->memoryCache->get('random'))->toBeNull();
})->group(__DIR__, __FILE__);

it('set get boolean values', function (): void {
    $this->memoryCache->set('isMobile', true, 100);
    expect($this->memoryCache->get('isMobile'))->toBeTrue();

    $this->memoryCache->set('isTablet', false, 100);
    expect($this->memoryCache->get('isTablet'))->toBeFalse();
})->group(__DIR__, __FILE__);

it('set get zero ttl', function (): void {
    $this->memoryCache->set('isMobile', true, 0);
    expect($this->memoryCache->get('isMobile'))->toBeNull();
})->group(__DIR__, __FILE__);

it('set get negative ttl', function (): void {
    $this->memoryCache->set('isMobile', true, -999);
    expect($this->memoryCache->get('isMobile'))->toBeNull();
})->group(__DIR__, __FILE__);

it('set zero ttlwith invalid key throws exception', function (): void {
    $this->memoryCache->set('', true, 0);
})->group(__DIR__, __FILE__)->throws(CacheInvalidArgumentException::class);

it('set negative ttlwith invalid key throws exception', function (): void {
    $this->memoryCache->set('', true, -999);
})->group(__DIR__, __FILE__)->throws(CacheInvalidArgumentException::class);

it('set valid ttlas an integer returns the set value', function (): void {
    $this->memoryCache->set('isMobile', 'someValue', 1000);
    expect($this->memoryCache->get('isMobile'))->toEqual('someValue');
})->group(__DIR__, __FILE__);

it('set null ttlreturns the set value', function (): void {
    $this->memoryCache->set('isMobile', 'abc');
    expect($this->memoryCache->get('isMobile'))->toEqual('abc');
})->group(__DIR__, __FILE__);

it('deletion of valid record', function (): void {
    $this->memoryCache->set('isMobile', 'a b c', 100);
    expect($this->memoryCache->get('isMobile'))->toEqual('a b c');

    $this->memoryCache->delete('isMobile');
    expect($this->memoryCache->get('isMobile'))->toBeNull();
})->group(__DIR__, __FILE__);

it('clear', function (): void {
    $this->memoryCache->set('isMobile', true);
    $this->memoryCache->set('isTablet', true);

    expect($this->memoryCache->getKeys())->toHaveCount(2);
    $this->memoryCache->clear();
    expect($this->memoryCache->getKeys())->toHaveCount(0);
})->group(__DIR__, __FILE__);

it('get multiple', function (): void {
    $this->memoryCache->set('isMobile', true, 100);
    $this->memoryCache->set('isTablet', false, 200);

    expect($this->memoryCache->getMultiple(['isMobile', 'isTablet', 'isUnknown']))->toEqual([
        'isMobile' => true,
        'isTablet' => false,
        'isUnknown' => null,
    ]);
})->group(__DIR__, __FILE__);

it('set multiple', function (): void {
    $this->memoryCache->setMultiple(['isA' => true, 'isB' => false], 200);
    expect($this->memoryCache->getMultiple(['isA', 'isB']))->toEqual([
        'isA' => true,
        'isB' => false,
    ]);
})->group(__DIR__, __FILE__);

it('set multiple with one invalid key', function (): void {
    expect($this->memoryCache->setMultiple(['a' => 'valueA', 'b' => 'valueB'], 0))->toBeFalse();
})->group(__DIR__, __FILE__);

it('delete multiple', function (): void {
    $this->memoryCache->setMultiple(['isA' => true, 'isB' => false, 'isC' => true], 300);

    $this->memoryCache->deleteMultiple(['isA', 'isB']);

    expect($this->memoryCache->getMultiple(['isA', 'isB', 'isC']))->toEqual([
        'isA' => null,
        'isB' => null,
        'isC' => true,
    ]);
})->group(__DIR__, __FILE__);

it('has returns true for valid cache record', function (): void {
    $this->memoryCache->set('isA', 'some value1');
    expect($this->memoryCache->has('isA'))->toBeTrue();
})->group(__DIR__, __FILE__);

it('has returns true for invalid cache record', function (): void {
    $this->memoryCache->set('isA', 'some value2', time());
    expect($this->memoryCache->has('isA'))->toBeTrue();
})->group(__DIR__, __FILE__);

it('has returns false for non existent cache record', function (): void {
    expect($this->memoryCache->has('non_existent'))->toBeFalse();
})->group(__DIR__, __FILE__);

it('has throws exception for non existent cache record', function (): void {
    $this->memoryCache->has('invalid key');
})->group(__DIR__, __FILE__)->throws(CacheInvalidArgumentException::class);
