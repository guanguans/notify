<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
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

namespace Guanguans\NotifyTests\Foundation\Authenticators;

use Guanguans\Notify\Foundation\Authenticators\CertificateAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\WsseAuthenticator;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

it('can apply the certificate to options', function (): void {
    expect(new CertificateAuthenticator(fixtures_path('cert.pem'), fake()->password))
        ->applyToOptions([])->toBeArray();
})->group(__DIR__, __FILE__);

it('can apply the wsse to request', function (): void {
    expect(new WsseAuthenticator(fake()->userName(), fake()->password()))
        ->applyToRequest(new Request('GET', fake()->url()))->toBeInstanceOf(RequestInterface::class);
})->group(__DIR__, __FILE__);
