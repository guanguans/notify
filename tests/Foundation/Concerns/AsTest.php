<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests\Foundation\Concerns;

use Guanguans\Notify\Foundation\Concerns\AsBody;
use Guanguans\Notify\Foundation\Concerns\AsDelete;
use Guanguans\Notify\Foundation\Concerns\AsGet;
use Guanguans\Notify\Foundation\Concerns\AsHead;
use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Guanguans\Notify\Foundation\Concerns\AsPatch;
use Guanguans\Notify\Foundation\Concerns\AsPut;
use Guanguans\Notify\Foundation\Concerns\AsQuery;
use Guanguans\Notify\Foundation\Message;

it('can convert to body option', function (): void {
    expect(
        (new class extends Message {
            use AsBody;
            use AsNullUri;
        })->toHttpOptions(),
    )->toBeArray();
})->group(__DIR__, __FILE__);

it('can convert to query option', function (): void {
    expect(
        (new class extends Message {
            use AsNullUri;
            use AsQuery;
        })->toHttpOptions(),
    )->toBeArray();
})->group(__DIR__, __FILE__);

it('can convert to delete method', function (): void {
    expect(
        (new class {
            use AsDelete;
        })->toHttpMethod(),
    )->toBe('DELETE');
})->group(__DIR__, __FILE__);

it('can convert to get method', function (): void {
    expect(
        (new class {
            use AsGet;
        })->toHttpMethod(),
    )->toBe('GET');
})->group(__DIR__, __FILE__);

it('can convert to head method', function (): void {
    expect(
        (new class {
            use AsHead;
        })->toHttpMethod(),
    )->toBe('HEAD');
})->group(__DIR__, __FILE__);

it('can convert to patch method', function (): void {
    expect(
        (new class {
            use AsPatch;
        })->toHttpMethod(),
    )->toBe('PATCH');
})->group(__DIR__, __FILE__);

it('can convert to put method', function (): void {
    expect(
        (new class {
            use AsPut;
        })->toHttpMethod(),
    )->toBe('PUT');
})->group(__DIR__, __FILE__);
