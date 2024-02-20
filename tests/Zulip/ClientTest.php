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
use Guanguans\Notify\Zulip\Messages\DirectMessage;
use Guanguans\Notify\Zulip\Messages\StreamMessage;
use Psr\Http\Message\ResponseInterface;

it('can send direct message', function (): void {
    $authenticator = new Authenticator(
        'coole-bot@chat.zulip.org',
        'mfMBi3UZQyHeWUh8gijtsAjpfp3Df',
    );
    $client = new Client($authenticator);
    $message = DirectMessage::make([
        'to' => 'coole-bot@chat.zulip.org',
        'content' => 'This is content.',
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"result":"success","msg":"","id":1740849}'),
            create_response('{"result":"error","msg":"Malformed API key","code":"UNAUTHORIZED"}', 401),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send stream message', function (): void {
    $authenticator = new Authenticator(
        'coole-bot@chat.zulip.org',
        'mfMBi3UZQyHeWUh8gijtsAjpfp3Df',
    );
    $client = new Client($authenticator);
    $message = StreamMessage::make([
        'to' => 'test here',
        'content' => 'This is content.',
        'topic' => 'bug',
        // 'queue_id' => '1593114627:0',
        // 'local_id' => '100.01',
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"result":"success","msg":"","id":1740849}'),
            create_response('{"result":"error","msg":"Malformed API key","code":"UNAUTHORIZED"}', 401),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
