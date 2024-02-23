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

namespace Guanguans\NotifyTests\YiFengChuanHua;

use Guanguans\Notify\YiFengChuanHua\Authenticator;
use Guanguans\Notify\YiFengChuanHua\Client;
use Guanguans\Notify\YiFengChuanHua\Messages\Message;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('2c893fadd3bd2416027008235fe32');
    $client = new Client($authenticator);
    $message = Message::make([
        'head' => 'This is title.',
        'body' => 'This is body.',
    ]);

    expect($client)
        ->mock([
            create_response('{"code":0,"message":"请求成功","data":{"messageIdList":["1341726823083966464"]}}'),
            create_response('{"code":46001,"message":"通道不存在","data":null}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
