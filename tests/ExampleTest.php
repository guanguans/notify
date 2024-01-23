<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

it('to be string.', function ($movie): void {
    expect($movie)->toBeString();
    $this->assertTrue(true);
    $this->markTestIncomplete('This test has not been implemented yet.');
    $this->markTestSkipped('The PostgreSQL extension is not available');
})->group(__DIR__, __FILE__)->with('movies');

it('is is snapshot.', function ($movie): void {
    $this->assertMatchesSnapshot($movie);
})->group(__DIR__, __FILE__)->with('movies')->skip();
