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

namespace Guanguans\NotifyTests\PushDeer;

use Guanguans\Notify\PushDeer\Authenticator;
use Guanguans\Notify\PushDeer\Client;
use Guanguans\Notify\PushDeer\Messages\Message;

use function Pest\Faker\faker;

it('can send message', function (): void {
    $authenticator = new Authenticator('PDU3062THLWPFpHEmFQrKhFp9Tlz9q0qE9Nfz');
    $client = new Client($authenticator);
    $message = Message::make([
        'text' => '## This is text.',
        'desp' => '> This is desp.',
        'type' => 'markdown',
    ]);

    expect($client)
        ->mock([
            create_response('{"code":0,"content":{"result":["{\"counts\":1,\"logs\":[],\"success\":\"ok\"}","{\"counts\":1,\"logs\":[],\"success\":\"ok\"}"]}}'),
            create_response(faker()->randomHtml(), 500),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
