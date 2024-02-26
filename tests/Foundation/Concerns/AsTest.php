<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\NotifyTests\Foundation\Concerns;

use Guanguans\Notify\Foundation\Concerns\AsBody;
use Guanguans\Notify\Foundation\Concerns\AsDelete;
use Guanguans\Notify\Foundation\Concerns\AsGet;
use Guanguans\Notify\Foundation\Concerns\AsHead;
use Guanguans\Notify\Foundation\Concerns\AsPatch;
use Guanguans\Notify\Foundation\Concerns\AsPut;
use Guanguans\Notify\Foundation\Concerns\AsQuery;
use Guanguans\Notify\Foundation\Concerns\HasOptions;

it('can convert to body option', function (): void {
    expect(
        (new class {
            use AsBody;
            use HasOptions;
        })->toHttpOptions()
    )->toBeArray();
})->group(__DIR__, __FILE__);

it('can convert to query option', function (): void {
    expect(
        (new class {
            use AsQuery;
            use HasOptions;
        })->toHttpOptions()
    )->toBeArray();
})->group(__DIR__, __FILE__);

it('can convert to delete method', function (): void {
    expect(
        (new class {
            use AsDelete;
        })->toHttpMethod()
    )->toBe('delete');
})->group(__DIR__, __FILE__);

it('can convert to get method', function (): void {
    expect(
        (new class {
            use AsGet;
        })->toHttpMethod()
    )->toBe('get');
})->group(__DIR__, __FILE__);

it('can convert to head method', function (): void {
    expect(
        (new class {
            use AsHead;
        })->toHttpMethod()
    )->toBe('head');
})->group(__DIR__, __FILE__);

it('can convert to patch method', function (): void {
    expect(
        (new class {
            use AsPatch;
        })->toHttpMethod()
    )->toBe('patch');
})->group(__DIR__, __FILE__);

it('can convert to put method', function (): void {
    expect(
        (new class {
            use AsPut;
        })->toHttpMethod()
    )->toBe('put');
})->group(__DIR__, __FILE__);
