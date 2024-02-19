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

namespace Guanguans\NotifyTests\Pushover;

use Guanguans\Notify\Pushover\Authenticator;
use Guanguans\Notify\Pushover\Client;
use Guanguans\Notify\Pushover\Messages\Message;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator(
        'uz86ivgu7xkizpdpdo65vw2c7d5',
        'abs9tevjnpu2p7x1yii8uf23qq9'
    );
    $client = new Client($authenticator);
    $message = Message::make([
        'message' => 'This is message.',
        // 'title' => 'This is title.',
        // 'timestamp' => time(),
        // 'priority' => 2,
        // 'url' => 'https://www.guanguans.cn',
        // 'url_title' => 'This is URL title.',
        // 'sound' => 'none',
        // 'retry' => 60,
        // 'expire' => 3600,
        // 'html' => 1,
        // 'monospace' => 0,
        // 'callback' => 'https://www.guanguans.cn/',
        // 'device' => 'This is device.',
        // 'attachment' => '/Users/yaozm/Downloads/images.jpeg',
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"status":1,"request":"a84b20eb-b69e-4687-83d1-bab8ee2d0e40"}'),
            create_response('{"token":"invalid","errors":["application token is invalid, see https://pushover.net/api"],"status":0,"request":"5c4487c0-a61a-497e-9205-3441a99471b0"}', 400),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
