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

namespace Guanguans\NotifyTests\Ntfy;

use Guanguans\Notify\Ntfy\Client;
use Guanguans\Notify\Ntfy\Messages\Message;

it('can send message', function (): void {
    $client = new Client;
    $message = Message::make([
        'topic' => 'guanguans',
        'message' => 'This is message.',
        'title' => 'This is title.',
        'tags' => ['tag1', 'tag2'],
        'priority' => 1,
        'actions' => [],
        'click' => 'https://www.guanguans.cn',
        'attach' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        'markdown' => true,
        'icon' => 'https://avatars0.githubusercontent.com/u/25671453?s=200&v=4',
        'filename' => 'avatar.png',
        // 'delay' => '30min, 9am',
        'email' => 'xxx@qq.com',
        // 'call' => '+8613948484984',
        'cache' => 'no',
        'firebase' => 'no',
    ])->addAction([
        'action' => 'view',
        'label' => 'Open portal',
        'url' => 'https://home.nest.com/',
        'clear' => true,
    ]);

    expect($client)
        ->mock([
            create_response('{"id":"ChjDFVOPqaBK","time":1708335367,"expires":1708378567,"event":"message","topic":"guanguans","title":"This is title.","message":"This is message.","priority":1,"tags":["tag1","tag2"],"click":"https://example.com","icon":"https://www.guanguans.cn","attachment":{"name":"file.jpg","url":"https://www.guanguans.cn"}}'),
            create_response(
                '{"code":40035,"http":400,"error":"invalid request: anonymous phone calls are not allowed","link":"https://ntfy.sh/docs/publish/#phone-calls"}',
                400
            ),
            create_response('{"code":40003,"http":400,"error":"delayed e-mail notifications are not supported"}', 400),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
