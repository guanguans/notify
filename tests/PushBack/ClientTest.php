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

namespace Guanguans\NotifyTests\PushBack;

use Guanguans\Notify\PushBack\Authenticator;
use Guanguans\Notify\PushBack\Client;
use Guanguans\Notify\PushBack\Messages\Message;
use Guanguans\Notify\PushBack\Messages\SyncMessage;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('at_b33c2bFrKAPmQr5-BaG');
    $client = new Client($authenticator);
    $message = Message::make([
        'id' => 'User_1730',
        'title' => 'This is title.',
        // 'body' => 'This is body.',
        // 'action1' => 'action1',
        // 'action2' => 'action2',
        // 'reply' => 'reply',
    ]);

    expect($client)
        ->mock([
            create_response('0'),
            create_response(
                <<<'error'
                    {
                      "errors": [
                        {
                          "message": "Unauthorized: Invalid access token"
                        }
                      ]
                    }
                    error
                ,
                401
            ),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send sync message', function (): void {
    $authenticator = new Authenticator('at_b33c2bFrKAPmQr5-BaG');
    $client = new Client($authenticator);
    $message = SyncMessage::make([
        'id' => 'User_1730',
        'title' => 'This is title.',
        'reply' => 'please reply me',
        // 'body' => 'This is body.',
        // 'action1' => 'action1',
        // 'action2' => 'action2',
    ]);

    expect($client)
        ->mock([
            create_response('This is reply message.'),
            create_response(
                <<<'error'
                    {
                      "errors": [
                        {
                          "message": "Unauthorized: Invalid access token"
                        }
                      ]
                    }
                    error
                ,
                401
            ),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
