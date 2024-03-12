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
        ->baseUri('Your mattermost server url.')
        ->mock([
            create_response(faker()->text()),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
