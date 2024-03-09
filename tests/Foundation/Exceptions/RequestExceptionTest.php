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

namespace Guanguans\NotifyTests\Foundation\Exceptions;

use Guanguans\Notify\Foundation\Exceptions\RequestException;
use Guanguans\Notify\Foundation\Exceptions\RuntimeException;
use GuzzleHttp\Psr7\Request;

it('can wrap exception', function (): void {
    expect(RequestException::wrapException(
        new Request('GET', 'uri'),
        new RuntimeException('message'),
    ))->toBeInstanceOf(RequestException::class);
})->group(__DIR__, __FILE__);
