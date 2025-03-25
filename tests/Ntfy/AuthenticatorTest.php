<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection StaticClosureCanBeUsedInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests\Ntfy;

use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Ntfy\Authenticator;

it('will throw an InvalidArgumentException', function (): void {
    new Authenticator(password: faker()->password());
})
    ->group(__DIR__, __FILE__)
    ->throws(InvalidArgumentException::class, 'When the password is not null, the usernameOrToken must be not null.');

it('can create an Authenticator', function (): void {
    expect([
        new Authenticator,
        new Authenticator(faker()->sha1()),
        new Authenticator(faker()->userName(), faker()->password()),
    ])->each->toBeInstanceOf(Authenticator::class);
})
    ->group(__DIR__, __FILE__);
