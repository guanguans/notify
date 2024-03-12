<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection DuplicateCustomExpectationInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

use Guanguans\Notify\Foundation\Client;
use Guanguans\Notify\Foundation\Message;
use Guanguans\NotifyTests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Pest\Expectation;
use Psr\Http\Message\ResponseInterface;

uses(TestCase::class)
    ->beforeAll(function (): void {})
    ->beforeEach(function (): void {})
    ->afterEach(function (): void {})
    ->afterAll(function (): void {})
    ->in(__DIR__, __DIR__.'/Feature', __DIR__.'/Unit');
/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
 */

expect()->extend('toBetween', fn (int $min, int $max): Expectation => expect($this->value)
    ->toBeGreaterThanOrEqual($min)
    ->toBeLessThanOrEqual($max));

expect()->extend('assert', function (Closure $assertions): Expectation {
    $assertions($this->value);

    return $this;
});

expect()->extend('assertCanSendMessage', function (Message $message): Expectation {
    $this->toBeInstanceOf(Client::class);

    /** @var Client $client */
    $client = $this->value;

    $queue = (fn (): array => (function (): array {
        expect($this->handler)->toBeInstanceOf(MockHandler::class);

        return (fn (): array => $this->queue)->call($this->handler);
    })->call($this->getHandlerStack()))->call($client);

    expect($queue)->each(function (Expectation $expectation) use ($client, $message): void {
        $expectation->toBeInstanceOf(ResponseInterface::class);

        /** @var ResponseInterface $response */
        $response = $expectation->value;

        expect($client->send($message))
            ->toBeInstanceOf(ResponseInterface::class)
            ->body()->toBe((string) $response->getBody())
            ->status()->toBe($response->getStatusCode());
    });

    return $this;
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
 */

/**
 * @param object|string $class
 *
 * @throws ReflectionException
 */
function class_namespace($class): string
{
    $class = \is_object($class) ? \get_class($class) : $class;

    return (new ReflectionClass($class))->getNamespaceName();
}

function fixtures_path(string $path = ''): string
{
    return __DIR__.\DIRECTORY_SEPARATOR.'fixtures'.($path ? \DIRECTORY_SEPARATOR.$path : $path);
}

/**
 * @noinspection ParameterDefaultsNullInspection
 *
 * @param null|mixed $body
 */
function create_response(
    $body = null,
    int $status = 200,
    array $headers = [],
    string $version = '1.1',
    ?string $reason = null
): ResponseInterface {
    return new Response($status, $headers, $body, $version, $reason);
}
