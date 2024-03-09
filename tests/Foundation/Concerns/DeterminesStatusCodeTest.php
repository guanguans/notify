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

use Guanguans\Notify\Foundation\Response;

it('can determine status code', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->ok()->toBeTrue()
        ->created()->toBeFalse()
        ->accepted()->toBeFalse()
        ->noContent()->toBeFalse()
        ->movedPermanently()->toBeFalse()
        ->found()->toBeFalse()
        ->notModified()->toBeFalse()
        ->badRequest()->toBeFalse()
        ->unauthorized()->toBeFalse()
        ->paymentRequired()->toBeFalse()
        ->forbidden()->toBeFalse()
        ->notFound()->toBeFalse()
        ->requestTimeout()->toBeFalse()
        ->conflict()->toBeFalse()
        ->unprocessableEntity()->toBeFalse()
        ->tooManyRequests()->toBeFalse();
})->group(__DIR__, __FILE__);
