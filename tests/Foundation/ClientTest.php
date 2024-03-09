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

namespace Guanguans\NotifyTests\Foundation;

use Guanguans\Notify\Foundation\Client;
use Guanguans\Notify\Foundation\Concerns\AsNullUri;

it('can dump debug info', function (): void {
    expect(new class extends Client {
        use AsNullUri;
    })->dump()->toBeInstanceOf(Client::class);
})->group(__DIR__, __FILE__);
