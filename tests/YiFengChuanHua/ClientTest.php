<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection StaticClosureCanBeUsedInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests\YiFengChuanHua;

use Guanguans\Notify\YiFengChuanHua\Authenticator;
use Guanguans\Notify\YiFengChuanHua\Client;
use Guanguans\Notify\YiFengChuanHua\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('2c893fadd3bd2416027008235fe32');
    $client = new Client($authenticator);
    $message = Message::make([
        'head' => 'This is title.',
        'body' => 'This is body.',
        'delayMilliseconds' => 5,
        'url' => 'https://github.com/guanguans/notify',
    ]);

    expect($client)
        ->mock([
            response('{"code":0,"message":"请求成功","data":{"messageIdList":["1341726823083966464"]}}'),
            response('{"code":46001,"message":"通道不存在","data":null}'),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
