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

use Guanguans\Notify\Foundation\Client;
use Guanguans\Notify\Foundation\Exceptions\BadMethodCallException;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use GuzzleHttp\HandlerStack;

it('will throw InvalidArgumentException when argument is empty', function (): void {
    /** @noinspection PhpParamsInspection */
    (new Client)->verify();
})
    ->group(__DIR__, __FILE__)
    ->throws(InvalidArgumentException::class, sprintf('The method [%s::verify] require an argument.', Client::class));

it('will throw BadMethodCallException when calling an undefined method', function (): void {
    /** @noinspection PhpUndefinedMethodInspection */
    (new Client)->foo();
})
    ->group(__DIR__, __FILE__)
    ->throws(BadMethodCallException::class, sprintf('The method [%s::foo] does not exist.', Client::class));

it('can set http client', function (): void {
    expect(new Client)
        ->setHttpClient(new \GuzzleHttp\Client)->toBeInstanceOf(Client::class);
})->group(__DIR__, __FILE__);

it('can set http client resolver', function (): void {
    expect(new Client)
        ->setHttpClientResolver(
            static fn (Client $client): \GuzzleHttp\Client => new \GuzzleHttp\Client,
        )
        ->toBeInstanceOf(Client::class);
})->group(__DIR__, __FILE__);

it('can set handler stack', function (): void {
    expect(new Client)
        ->setHandlerStack(HandlerStack::create())->toBeInstanceOf(Client::class);
})->group(__DIR__, __FILE__);
