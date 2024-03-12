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
