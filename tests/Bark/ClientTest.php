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

namespace Guanguans\NotifyTests\Bark;

use Guanguans\Notify\Bark\Authenticator;
use Guanguans\Notify\Bark\Client;
use Guanguans\Notify\Bark\Messages\Message;
use Psr\Http\Message\ResponseInterface;

it('can send message', function (): void {
    $authenticator = new Authenticator('yetwhxBm7wCBSUTjeqh');
    $client = new Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'body' => 'This is body.',
        // 'level' => 'active',
        // 'badge' => 3,
        // 'autoCopy' => 1,
        // 'copy' => 'This is copy.',
        // 'sound' => 'bell',
        // 'icon' => 'https://avatars0.githubusercontent.com/u/25671453?s=200&v=4',
        // 'group' => 'This is group.',
        // 'isArchive' => 1,
        // 'url' => 'https://github.com/guanguans/notify',
    ]);

    expect($client)
        ->mock([
            create_response('{"code":200,"message":"success","timestamp":1708331409}'),
            create_response('{"code":400,"message":"failed to get device token: failed to get [yetwhxBm7wCBSUTjeqh] device token from database","timestamp":1708331590}', 400),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
