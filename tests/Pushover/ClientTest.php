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

namespace Guanguans\NotifyTests\Pushover;

use Guanguans\Notify\Pushover\Authenticator;
use Guanguans\Notify\Pushover\Client;
use Guanguans\Notify\Pushover\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator(
        'uz86ivgu7xkizpdpdo65vw2c7d5',
        'abs9tevjnpu2p7x1yii8uf23qq9',
    );
    $client = new Client($authenticator);
    $message = Message::make([
        'message' => 'This is message.',
        'attachment' => 'tests/fixtures/image.png',
        'device' => 'This is device.',
        'html' => 1,
        'priority' => 2,
        'sound' => 'none',
        'timestamp' => time(),
        'title' => 'This is title.',
        'ttl' => 3600,
        'url' => 'https://www.guanguans.cn',
        'url_title' => 'This is url title.',
        'retry' => 60,
        'expire' => 3600,
        'monospace' => 0,
        'callback' => 'https://www.guanguans.cn/',
    ]);

    expect($client)
        ->mock([
            create_response('{"status":1,"request":"a84b20eb-b69e-4687-83d1-bab8ee2d0e40"}'),
            create_response(
                '{"token":"invalid","errors":["application token is invalid, see https://pushover.net/api"],"status":0,"request":"5c4487c0-a61a-497e-9205-3441a99471b0"}',
                400,
            ),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
