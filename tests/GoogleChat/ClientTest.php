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

namespace Guanguans\NotifyTests\Bark;

use Guanguans\Notify\GoogleChat\Authenticator;
use Guanguans\Notify\GoogleChat\Client;
use Guanguans\Notify\GoogleChat\Messages\Message;

use function Pest\Faker\faker;

it('can send message', function (): void {
    $authenticator = new Authenticator('spaceId', 'key', 'token', 'threadKey');
    $client = new Client($authenticator);
    $message = Message::make([
        'text' => 'This is text.',
    ]);

    expect($client)
        ->mock([
            create_response(faker()->text()),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
