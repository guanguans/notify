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

namespace Guanguans\NotifyTests\Zulip;

use Guanguans\Notify\Zulip\Authenticator;
use Guanguans\Notify\Zulip\Client;
use Guanguans\Notify\Zulip\Messages\Message;

beforeEach(function (): void {
    $authenticator = new Authenticator(
        'xxx@qq.com',
        'mh4JvrIQzzkcBobWYLiFEOvI25t4Q',
    );
    $this->client = (new Client($authenticator))
        ->baseUri('https://xxx.zulipchat.com/')
        ->mock([
            create_response('{"result":"success","msg":"","id":1740849}'),
            create_response('{"result":"error","msg":"Malformed API key","code":"UNAUTHORIZED"}', 401),
        ]);
});

it('can send direct message', function (): void {
    $message = Message::make([
        'type' => 'direct',
        'to' => 'xxx@qq.com',
        'content' => 'This is content.',
    ]);

    expect($this->client)->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);

it('can send stream message', function (): void {
    $message = Message::make([
        'type' => 'stream',
        'to' => 'general',
        'content' => 'This is content.',
        'topic' => 'bug',
        'queue_id' => '1593114627:0',
        'local_id' => '100.01',
    ]);

    expect($this->client)->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
