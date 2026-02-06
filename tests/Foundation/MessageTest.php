<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpFieldAssignmentTypeMismatchInspection */
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

namespace Guanguans\NotifyTests\Foundation;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Guanguans\Notify\Foundation\Message;

it('can dump debug info', function (): void {
    expect(new class extends Message {
        use AsNullUri;
    })->dump()->toBeInstanceOf(Message::class);
})->group(__DIR__, __FILE__);

it('can to form params', function (): void {
    expect((fn (): string => $this->toFormParams())->call(new class extends Message {
        use AsNullUri;
    }))->toBeString();
})->group(__DIR__, __FILE__);

it('can to query', function (): void {
    expect((fn (): string => $this->toQuery())->call(new class extends Message {
        use AsNullUri;
    }))->toBeString();
})->group(__DIR__, __FILE__);

it('can to Multipart', function (): void {
    expect((fn (): string => $this->toMultiPart())->call(new class extends Message {
        use AsNullUri;
    }))->toBeString();
})->group(__DIR__, __FILE__);
