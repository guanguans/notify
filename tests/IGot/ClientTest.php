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

namespace Guanguans\NotifyTests\IGot;

use Guanguans\Notify\IGot\Authenticator;
use Guanguans\Notify\IGot\Client;
use Guanguans\Notify\IGot\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('5dcd2f91d38cc47447414');
    $client = new Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'content' => 'This is content.',
        'url' => 'https://www.github.com/guanguans/notify',
        'automaticallyCopy' => 1,
        'urgent' => 1,
        'copy' => 'This is copy.',
        'detail' => [
            'foo' => 'This is detail foo.',
            'bar' => 'This is detail bar.',
        ],
    ]);

    expect($client)
        ->mock([
            create_response('{"ret":0,"data":{"id":"65d31d11adda140033fc8c17"},"errMsg":"发送成功"}'),
            create_response('{"ret":201,"data":{},"errMsg":"请使用系统分配的有效key"}'),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
