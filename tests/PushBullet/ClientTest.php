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

namespace Guanguans\NotifyTests\PushBullet;

use Guanguans\Notify\PushBullet\Authenticator;
use Guanguans\Notify\PushBullet\Client;
use Guanguans\Notify\PushBullet\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('o.6UZlb92nYG8XIloqKdUecYVamaP3A');
    $client = new Client($authenticator);
    $message = Message::make([
        'type' => 'link',
        'title' => 'This is title.',
        'body' => 'This is body.',
        'url' => 'https://github.com/guanguans/notify',
    ]);

    expect($client)
        ->mock([
            create_response('{"active":true,"iden":"ujEkbcC7F0esjuPmSKdbKC","created":1709867052.256945,"modified":1709867052.256945,"type":"link","dismissed":false,"direction":"self","sender_iden":"ujEkbcC7F0e","sender_email":"yzmguanguans@gmail.com","sender_email_normalized":"yzmguanguans@gmail.com","sender_name":"姚明明","receiver_iden":"ujEkbcC7F0e","receiver_email":"yzmguanguans@gmail.com","receiver_email_normalized":"yzmguanguans@gmail.com","title":"This is title.","body":"This is body.","url":"https://github.com/guanguans/notify"}'),
            create_response('{"error":{"code":"invalid_access_token","type":"invalid_request","message":"Access token is missing or invalid.","cat":"(=^･ω･^)y＝"},"error_code":"invalid_access_token"}', 401),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
