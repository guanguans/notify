<?php

/** @noinspection PhpUnused */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
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
use PhpBench\Attributes\BeforeMethods;
use PhpBench\Attributes\Revs;

#[BeforeMethods('setUp')]
#[Revs(10000)]
final class CreateInstanceBench
{
    private \Guanguans\Notify\Foundation\Contracts\Authenticator $authenticator;

    public function setUp(): void
    {
        $this->authenticator = new Authenticator('yetwhxBm7wCBSUTjeqh');
    }

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
        new Client($this->authenticator);
    }
}
