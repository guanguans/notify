<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests\ServerChan;

use Guanguans\Notify\ServerChan\Authenticator;
use Guanguans\Notify\ServerChan\Client;
use Guanguans\Notify\ServerChan\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('SCT35149Thtf1g2Bc14QJuQ6HFpW5Y');
    $client = new Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'desp' => 'This is desp.',
        'short' => 'This is short.',
        'noip' => 0,
        'channel' => '1|9',
        // 'openid' => 'f096edb95f92540219a41e4706',
    ]);

    expect($client)
        ->mock([
            create_response('{"code":0,"message":"","data":{"pushid":"156157448","readkey":"SCTRd7BkgAHn6XG","error":"SUCCESS","errno":0}}'),
            create_response(
                '{"message":"[AUTH]\u9519\u8bef\u7684Key","code":40001,"info":"\u9519\u8bef\u7684Key","args":[null],"scode":461}',
                400,
            ),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
