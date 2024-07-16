<?php

/** @noinspection PhpUnused */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\PackageSkeleton\Tests\Benchmark;

use Guanguans\Notify\Bark\Authenticator;
use Guanguans\Notify\Bark\Client;
use Guanguans\Notify\Bark\Messages\Message;
use GuzzleHttp\Psr7\HttpFactory;

/**
 * @beforeMethods({"setUp"})
 *
 * @warmup(1)
 *
 * @revs(10000)
 *
 * @iterations(3)
 */
final class NotifyBench
{
    public function setUp(): void {}

    public function benchCreateAuthenticator(): void
    {
        new Authenticator('yetwhxBm7wCBSUTjeqh');
    }

    public function benchCreateMessage(): void
    {
        Message::make([
            'title' => 'This is title.',
            'body' => 'This is body.',
            'level' => 'active',
            'badge' => 3,
            'autoCopy' => 1,
            'copy' => 'This is copy.',
            'sound' => 'bell',
            'icon' => 'https://avatars0.githubusercontent.com/u/25671453?s=200&v=4',
            'group' => 'This is group.',
            'isArchive' => 1,
            'url' => 'https://github.com/guanguans/notify',
        ]);
    }

    public function benchCreateClient(): void
    {
        new Client(new Authenticator('yetwhxBm7wCBSUTjeqh'));
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function benchSendMessage(): void
    {
        (new Client(new Authenticator('yetwhxBm7wCBSUTjeqh')))
            ->mock([
                (new HttpFactory)->createResponse(200, '{"code":200,"message":"success","timestamp":1708331409}'),
                // (new HttpFactory)->createResponse(400, '{"code":400,"message":"failed to get device token: failed to get [yetwhxBm7wCBSUTjeqh] device token from database","timestamp":1708331590}'),
            ])
            ->send(Message::make([
                'title' => 'This is title.',
                'body' => 'This is body.',
                'level' => 'active',
                'badge' => 3,
                'autoCopy' => 1,
                'copy' => 'This is copy.',
                'sound' => 'bell',
                'icon' => 'https://avatars0.githubusercontent.com/u/25671453?s=200&v=4',
                'group' => 'This is group.',
                'isArchive' => 1,
                'url' => 'https://github.com/guanguans/notify',
            ]));
    }
}
