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
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $client = new Client;
    $message = Message::make([
        'topic' => 'guanguans',
        'message' => 'This is message.',
        'title' => 'This is title.',
        'priority' => 1,
        'tags' => ['tag1', 'tag2'],
        'click' => 'https://example.com',
        'attach' => 'https://www.guanguans.cn',
        'icon' => 'https://www.guanguans.cn',
        'filename' => 'file.jpg',
        'cache' => 'no',
        'firebase' => 'no',
        // 'actions' => [],
        // 'delay' => '30min, 9am',
        // 'email' => 'xxx@qq.com',
    ]);

    expect($client)
        ->mock([
            create_response('{"id":"ChjDFVOPqaBK","time":1708335367,"expires":1708378567,"event":"message","topic":"guanguans","title":"This is title.","message":"This is message.","priority":1,"tags":["tag1","tag2"],"click":"https://example.com","icon":"https://www.guanguans.cn","attachment":{"name":"file.jpg","url":"https://www.guanguans.cn"}}'),
            create_response('{"id":"ChjDFVOPqaBK","time":1708335367,"expires":1708378567,"event":"message","topic":"guanguans","title":"This is title.","message":"This is message.","priority":1,"tags":["tag1","tag2"],"click":"https://example.com","icon":"https://www.guanguans.cn","attachment":{"name":"file.jpg","url":"https://www.guanguans.cn"}}'),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
