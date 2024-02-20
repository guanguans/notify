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

namespace Guanguans\NotifyTests\WeWorkGroupBot;

use Guanguans\Notify\WeWorkGroupBot\Authenticator;
use Guanguans\Notify\WeWorkGroupBot\Client;
use Guanguans\Notify\WeWorkGroupBot\Messages\TextMessage;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('73a3d5a3-ceff-4da8-bcf3-ff5891778');
    $client = new Client($authenticator);
    $message = TextMessage::make([
        'content' => 'This is content.',
        // 'mentioned_list' => ['wangqing', '@all'],
        // 'mentioned_mobile_list' => ['13800001111', '@all'],
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"errcode":0,"errmsg":"ok"}'),
            create_response('{"errcode":93000,"errmsg":"invalid webhook url, hint: [1708397705432012366598976], from ip: 218.72.126.124, more info at https://open.work.weixin.qq.com/devtool/query?e=93000"}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
