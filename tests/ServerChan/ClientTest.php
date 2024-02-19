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

namespace Guanguans\NotifyTests\ServerChan;

use Guanguans\Notify\ServerChan\Authenticator;
use Guanguans\Notify\ServerChan\Client;
use Guanguans\Notify\ServerChan\Messages\Message;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('SCT35149Thtf1g2Bc14QJuQ6HFpW5Y');
    $client = new Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'desp' => 'This is desp.',
    ]);

    expect($client)
        ->httpErrors(false)
        ->mock([
            create_response('{"code":0,"message":"","data":{"pushid":"156157448","readkey":"SCTRd7BkgAHn6XG","error":"SUCCESS","errno":0}}'),
            create_response('{"message":"[AUTH]\u9519\u8bef\u7684Key","code":40001,"info":"\u9519\u8bef\u7684Key","args":[null],"scode":461}', 400),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
