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

namespace Guanguans\NotifyTests\Bark;

use Guanguans\Notify\Gitter\Authenticator;
use Guanguans\Notify\Gitter\Client;
use Guanguans\Notify\Gitter\Messages\Message;
use function Pest\Faker\faker;

it('can send message', function (): void {
    $authenticator = new Authenticator(
        '61af21b96da03739848bfef',
        'b9e7931ecacb08b7ab4df5e98bc149d33d7faf1',
    );
    $client = new Client($authenticator);
    $message = Message::make()->text('This is text.');

    expect($client)
        ->mock([
            create_response(faker()->text()),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
