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

use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Guanguans\Notify\Foundation\Message;

it('can dump debug info', function (): void {
    expect(new class extends Message {
        use AsNullUri;
    })->dump()->toBeInstanceOf(Message::class);
})->group(__DIR__, __FILE__);
