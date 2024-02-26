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

namespace Guanguans\NotifyTests\ShowdocPush;

use Guanguans\Notify\ShowdocPush\Authenticator;
use Guanguans\Notify\ShowdocPush\Client;
use Guanguans\Notify\ShowdocPush\Messages\Message;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('f096edb95f92540219a41e47060eeb6d946199');
    $client = new Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'content' => 'This is content.',
    ]);

    expect($client)
        ->mock([
            create_response('{"error_code":0,"error_message":"ok"}'),
            create_response('{"error_code":10103,"error_message":"url\u6216token\u4e0d\u6b63\u786e"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
