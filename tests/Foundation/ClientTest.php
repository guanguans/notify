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

namespace Guanguans\NotifyTests\Foundation;

use Guanguans\Notify\Foundation\Client;
use Guanguans\Notify\Foundation\Concerns\AsNullUri;

it('can dump debug info', function (): void {
    expect(new class extends Client {
        use AsNullUri;
    })->dump()->toBeInstanceOf(Client::class);
})->group(__DIR__, __FILE__);
