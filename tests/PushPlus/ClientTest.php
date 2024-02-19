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
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('f8fbd292ba3a4875967fd81bf0290');
    $client = new Client($authenticator);
    $message = Message::make([
        'content' => 'This is content.',
        // 'title' => 'This is title.',
        // 'template' => 'html',
        // 'topic' => 'topic',
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"code":200,"msg":"请求成功","data":"aab34a37c1ff49ef8087cb3cd2c0d1ff","count":null}'),
            create_response('{"code":903,"msg":"无效的用户token","data":null}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
