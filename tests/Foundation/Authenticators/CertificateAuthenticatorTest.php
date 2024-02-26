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

namespace Guanguans\NotifyTests\Foundation\Authenticators;

use Guanguans\Notify\Foundation\Authenticators\CertificateAuthenticator;

use function Pest\Faker\faker;

it('can apply to options', function (): void {
    expect(new CertificateAuthenticator(fixtures_path('cert.pem'), faker()->password))
        ->applyToOptions([])->toBeArray();
})->group(__DIR__, __FILE__);
