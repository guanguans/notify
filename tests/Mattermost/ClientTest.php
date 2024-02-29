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

namespace Guanguans\NotifyTests\Mattermost;

use Guanguans\Notify\Mattermost\Authenticator;
use Guanguans\Notify\Mattermost\Client;
use Guanguans\Notify\Mattermost\Messages\Message;

use function Pest\Faker\faker;

it('can send message', function (): void {
    $authenticator = new Authenticator('r7jezodttibgueijpahyyfh1qa');
    $client = new Client($authenticator);
    $message = Message::make([
        'channel_id' => 'sat5ohbs5byixd86tmxtk13',
        'message' => 'This is message.',
        'is_pinned' => true,
        'create_at' => 1639041968509,
        'edit_at' => 1639041968509,
        'root_id' => '',
        'original_id' => '',
        'type' => '',
        'pending_post_id' => '1639041968509abc',
        'participants' => null,
        'props' => ['key' => 'value'],
        'file_ids' => ['o3x4y157jff5xydf5m91bft1oo'],
    ]);

    expect($client)
        // ->baseUri('https://guanguans.cloud.mattermost.com')
        ->baseUri('Your Mattermost server URL.')
        ->mock([
            create_response(faker()->text()),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
