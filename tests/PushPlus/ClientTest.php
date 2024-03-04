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

namespace Guanguans\NotifyTests\PushPlus;

use Guanguans\Notify\PushPlus\Authenticator;
use Guanguans\Notify\PushPlus\Client;
use Guanguans\Notify\PushPlus\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('f8fbd292ba3a4875967fd81bf0290');
    $client = new Client($authenticator);
    $message = Message::make([
        // 'topic' => 'This is group.', // 群组消息
        // 'to' => '5813c18bb0fa462789028312dae30224', // 好友消息
        'title' => 'This is title.',
        'content' => 'This is content',
        'template' => 'html',
        'channel' => 'wechat',
        'webhook' => 'pushplus',
        'callbackUrl' => 'https://www.guanguans.cn',
        'timestamp' => time() * 1001,
    ]);

    expect($client)
        ->mock([
            create_response('{"code":200,"msg":"请求成功","data":"aab34a37c1ff49ef8087cb3cd2c0d1ff","count":null}'),
            create_response('{"code":903,"msg":"无效的用户token","data":null}'),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
