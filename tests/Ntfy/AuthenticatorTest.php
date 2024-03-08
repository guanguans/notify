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

namespace Guanguans\NotifyTests\Ntfy;

use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Ntfy\Authenticator;

use function Pest\Faker\faker;

it('will throw an InvalidArgumentException', function (): void {
    new Authenticator('foo', 'bar', 'baz');
})
    ->group(__DIR__, __FILE__)
    ->throws(InvalidArgumentException::class, 'The number of arguments must be 0, 1 or 2.');

it('can create an Authenticator', function (): void {
    expect([
        new Authenticator,
        new Authenticator(faker()->sha1()),
        new Authenticator(faker()->userName(), faker()->password()),
    ])->each->toBeInstanceOf(Authenticator::class);
})
    ->group(__DIR__, __FILE__);
