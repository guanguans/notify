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
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('5dcd2f91d38cc47447414');
    $client = new Client($authenticator);
    $message = Message::make([
        'content' => 'This is content.',
        // 'title' => 'This is title.',
        // 'url' => 'https://www.github.com/guanguans/notify',
        // 'automaticallyCopy' => 1,
        // 'urgent' => 1,
        // 'copy' => 'This is copy.',
        // 'detail' => [
        //     'title' => 'This is detail title.',
        //     'content' => 'This is detail content.',
        // ],
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"ret":0,"data":{"id":"65d31d11adda140033fc8c17"},"errMsg":"发送成功"}'),
            create_response('{"ret":201,"data":{},"errMsg":"请使用系统分配的有效key"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
