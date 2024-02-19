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

namespace Guanguans\NotifyTests\Push;

use Guanguans\Notify\Push\Authenticator;
use Guanguans\Notify\Push\Client;
use Guanguans\Notify\Push\Messages\Message;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('5db80e8a-1f9b-4f98-929a-75892cedc');
    $client = new Client($authenticator);
    $message = Message::make([
        'title' => 'This is a title.',
        'body' => 'This is a body.',
        // 'link' => 'https://github.com/guanguans/notify',
        // 'image' => 'https://www.nowpush.app/assets/img/welcome/welcome-mockup.png',
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"success":true,"responses":[{"success":true,"message":"Message send to device"},{"success":true,"message":"Message send to device"}]}'),
            create_response('{"success":false,"message":"Invalid API key, authentication failed"}', 401),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
