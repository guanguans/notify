<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection DuplicateCustomExpectationInspection */

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Guanguans\NotifyTests\TestCase;
use Pest\Expectation;

uses(TestCase::class, GuzzleHttp\Psr7\HttpFactory::class)
    ->beforeAll(function (): void {})
    ->beforeEach(function (): void {})
    ->afterEach(function (): void {})
    ->afterAll(function (): void {})
    ->in(__DIR__.'/Feature', __DIR__.'/Unit');
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

expect()->extend('toBeOne', fn () => $this->toBe(1));

expect()->extend('assert', function (Closure $assertions): Expectation {
    $assertions($this->value);

    return $this;
});

expect()->extend('between', function (int $min, int $max): Expectation {
    expect($this->value)
        ->toBeGreaterThanOrEqual($min)
        ->toBeLessThanOrEqual($max);

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
    $class = is_object($class) ? get_class($class) : $class;

    return (new ReflectionClass($class))->getNamespaceName();
}

function fixtures_path(string $path = ''): string
{
    return __DIR__.'/Fixtures'.($path ? \DIRECTORY_SEPARATOR.$path : $path);
}
