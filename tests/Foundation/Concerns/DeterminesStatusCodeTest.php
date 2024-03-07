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
