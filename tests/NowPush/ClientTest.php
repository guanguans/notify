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

namespace Guanguans\NotifyTests\NowPush;

use Guanguans\Notify\NowPush\Authenticator;
use Guanguans\Notify\NowPush\Client;
use Guanguans\Notify\NowPush\Messages\ImageMessage;
use Guanguans\Notify\NowPush\Messages\LinkMessage;
use Guanguans\Notify\NowPush\Messages\NoteMessage;

use function Pest\Faker\faker;

beforeEach(function (): void {
    $authenticator = new Authenticator('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL');
    $this->client = (new Client($authenticator))->mock([
        create_response(faker()->text()),
    ]);
});

it('can send image message', function (): void {
    $imageMessage = ImageMessage::make([
        'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    ]);

    expect($this->client)->assertCanSendMessage($imageMessage);
})->group(__DIR__, __FILE__);

it('can send link message', function (): void {
    $linkMessage = LinkMessage::make([
        'url' => 'https://github.com/guanguans/notify',
    ]);

    expect($this->client)->assertCanSendMessage($linkMessage);
})->group(__DIR__, __FILE__);

it('can send note message', function (): void {
    $noteMessage = NoteMessage::make([
        'note' => 'This is note.',
    ]);

    expect($this->client)->assertCanSendMessage($noteMessage);
})->group(__DIR__, __FILE__);
