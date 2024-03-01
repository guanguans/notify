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

namespace Guanguans\NotifyTests\Foundation\Exceptions;

use Guanguans\Notify\Foundation\Exceptions\RequestException;
use Guanguans\Notify\Foundation\Exceptions\RuntimeException;
use GuzzleHttp\Psr7\Request;

it('can wrap exception', function (): void {
    expect(RequestException::wrapException(
        new Request('GET', 'uri'),
        new RuntimeException('message')
    ))->toBeInstanceOf(RequestException::class);
})->group(__DIR__, __FILE__);
