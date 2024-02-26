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

use Guanguans\Notify\Foundation\Authenticators\WsseAuthenticator;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

use function Pest\Faker\faker;

it('can apply to request', function (): void {
    expect(new WsseAuthenticator(faker()->userName(), faker()->password()))
        ->applyToRequest(new Request('GET', faker()->url()))->toBeInstanceOf(RequestInterface::class);
})->group(__DIR__, __FILE__);
