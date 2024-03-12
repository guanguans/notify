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

namespace Guanguans\NotifyTests\NowPush;

use Guanguans\Notify\NowPush\Authenticator;
use Guanguans\Notify\NowPush\Client;
use Guanguans\Notify\NowPush\Messages\Message;
use function Pest\Faker\faker;

beforeEach(function (): void {
    $authenticator = new Authenticator('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL');
    $this->client = (new Client($authenticator))->mock([
        create_response(faker()->text()),
    ]);
});

it('can send image message', function (): void {
    $imageMessage = Message::make([
        'message_type' => 'nowpush_img',
        'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    ]);

    expect($this->client)->assertCanSendMessage($imageMessage);
})->group(__DIR__, __FILE__);

it('can send link message', function (): void {
    $linkMessage = Message::make([
        'message_type' => 'nowpush_link',
        'url' => 'https://github.com/guanguans/notify',
    ]);

    expect($this->client)->assertCanSendMessage($linkMessage);
})->group(__DIR__, __FILE__);

it('can send note message', function (): void {
    $noteMessage = Message::make([
        'message_type' => 'nowpush_note',
        'note' => 'This is note.',
    ]);

    expect($this->client)->assertCanSendMessage($noteMessage);
})->group(__DIR__, __FILE__);
